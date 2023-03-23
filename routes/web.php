<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('on-off', [AdminController::class, 'onOff'])->name('admin.on-off');
    Route::post('sort', [AdminController::class, 'sort'])->name('admin.sort');
    Route::delete('destroy', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::resource('languages', LanguageController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('backups/{backup}/download', [BackupController::class, 'download'])->name('backups.download');
    Route::get('backups/created-from-file', [BackupController::class, 'createFromFile'])->name('backups.createFromFile');
    Route::post('backups/store-from-file', [BackupController::class, 'storeFromFile'])->name('backups.storeFromFile');
    Route::post('backups/{backup}/restore', [BackupController::class, 'restore'])->name('backups.restore');
    Route::resource('backups', BackupController::class);

    Route::delete('events/clear', [EventController::class, 'clear'])->name('events.clear');
    Route::resource('events', EventController::class);

    Route::resource('menus', MenuController::class);
    Route::post('menus/add-sub-menus', [MenuController::class, 'addSubMenus'])->name('menus.addSubMenus');

    Route::resource('templates', TemplateController::class);
    Route::post('templates/add', [TemplateController::class, 'addSubTemplate'])->name('templates.add');

    Route::put('blocks/update-general', [BlockController::class, 'updateGeneral'])->name('blocks.update-general');
    Route::post('blocks/add-sub-blocks', [BlockController::class, 'addSubBlocks'])->name('blocks.addSubBlocks');
    Route::resource('blocks', BlockController::class);

    Route::resource('pages', PageController::class);
    Route::get('pages/{page}/add-block', [PageController::class, 'addBlock'])->name('pages.add.block');
});


require __DIR__ . '/auth.php';

Route::get('/{language?}/{slug?}', [SiteController::class, 'page'])->name('page');



