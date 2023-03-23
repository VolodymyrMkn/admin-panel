<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArchiveRequest;
use App\Models\Backup;
use App\Http\Requests\StoreBackupRequest;
use App\Http\Requests\UpdateBackupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Spatie\DbDumper\Databases\MySql;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $backups = Backup::orderBy('created_at', 'desc')->get();
        return view('backups.index', compact(['backups']));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBackupRequest  $request
     */
    public function store(StoreBackupRequest $request)
    {
        $backUp = Backup::create($request->validated());

        $dbConfig=Config::get('database.connections')['mysql'];
        $tablesToBackUp = ['languages', 'pages', 'categories', 'menus', 'templates', 'blocks'];
        $dumpName = "sql/dump$backUp->id.sql";

        try {
            \File::copyDirectory(public_path('storage'), storage_path("backups/$backUp->id"));
        } catch (\Exception $e) {
            $backUp->delete();
            return to_route('backups.index')
                ->with(['message' => 'Backup was not created: <br>' .$e->getMessage(), 'type' => 'dark']);
        }
        try {
            if (!\File::exists(public_path('sql'))) {
                \File::makeDirectory(public_path('sql'), 0755, true);
            }

            MySql::create()
                ->setDbName($dbConfig['database'])
                ->setUserName($dbConfig['username'])
                ->setPassword($dbConfig['password'])
                ->includeTables($tablesToBackUp)
                ->dumpToFile($dumpName);
            if (!\File::exists(storage_path('sql'))) {
                \File::makeDirectory(storage_path('sql'), 0755, true);
            }

            \File::copy(public_path($dumpName), storage_path($dumpName));
            \File::deleteDirectory(public_path('sql'));

        } catch (\Exception $e) {

            $backUp->delete();
            return to_route('backups.index')
                ->with(['message' => 'Backup was not created: <br>' .$e->getMessage(), 'type' => 'dark']);
        }

        return to_route('backups.index')
            ->with(['message' => 'Backup was created', 'type' => 'success']);
    }

    public function restore(Backup $backup)
    {
        $tablesToBackUp = ['languages', 'blocks', 'pages', 'categories', 'menus', 'templates'];

        if(is_dir(storage_path("backups/$backup->id"))) {
            if(file_exists(storage_path("sql/dump$backup->id.sql"))) {
                \File::copyDirectory(public_path("backups/$backup->id"), storage_path('storage'));

                foreach ($tablesToBackUp as $table) {
                    Schema::dropIfExists($table);
                }

                $dumpName = "sql/dump$backup->id.sql";
                DB::unprepared(file_get_contents(storage_path($dumpName)));
            } else {
                return to_route('backups.index')
                    ->with(['message' => "SQL dump does not exists", 'type' => 'dark']);
            }
        } else {
            return to_route('backups.index')
                ->with(['message' => "Backup folder does not exists", 'type' => 'dark']);
        }

        return to_route('backups.index')
            ->with(['message' => 'Backup was update', 'type' => 'success']);
    }

    public function download(Backup $backup)
    {
        $backup = Backup::find($backup->id);
        $date = $backup->created_at->toDateTimeString();
        $date = str_replace([' ', ':'], '-', $date);


        $zip_file = "backup-$date.zip";
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = storage_path("backups/$backup->id");
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();

                // extracting filename with substr/strlen
                $relativePath = "backup/$backup->id/" . substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->addFile(storage_path("sql/dump$backup->id.sql"), "sql/dump$backup->id.sql");
        $zip->close();
        return response()->download($zip_file);
    }

    public function createFromFile()
    {
        return view('backups.createFromFile');
    }

    public function storeFromFile(StoreBackupRequest $request, ArchiveRequest $archiveRequest)
    {
        $zip = new \ZipArchive();
        $status = $zip->open($archiveRequest->file("file")->getRealPath());
        if ($status !== true) {
            return to_route('backups.index')
                ->with(['message' => "Backup creating error", 'type' => 'dark']);
        } else{
            $backup = Backup::create($request->validated());
            $storageDestinationPath= storage_path("temp");

            if (!\File::exists( $storageDestinationPath)) {
                \File::makeDirectory($storageDestinationPath, 0755, true);
            }
            $zip->extractTo($storageDestinationPath);
            $zip->close();

            $backupStorageName = scandir(storage_path('temp/backup'));
            $folderName = end($backupStorageName);

            \File::copyDirectory(storage_path("temp/backup/$folderName"), storage_path("backups/$backup->id"));
            \File::copy(storage_path("temp/sql/dump$folderName.sql"), storage_path("sql/dump$backup->id.sql"));
            \File::deleteDirectory(storage_path('temp'));

            return to_route('backups.index')
                ->with(['message' => 'Backup was created', 'type' => 'success']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function show(Backup $backup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     */
    public function edit(Backup $backup)
    {
        return view('backups.edit', compact(['backup']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBackupRequest  $request
     * @param  \App\Models\Backup  $backup
     */
    public function update(UpdateBackupRequest $request, Backup $backup)
    {
        $backup->update($request->validated());
        return to_route('backups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backup  $backup
     */
    public function destroy(Backup $backup)
    {
        \File::deleteDirectory(storage_path("backups/$backup->id"));
        \File::delete(storage_path("sql/dump$backup->id.sql"));

        $backup->delete();
        return to_route('backups.index')
            ->with(['message' => 'Backup was delete', 'type' => 'success']);
    }
}
