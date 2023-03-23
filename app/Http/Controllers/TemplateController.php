<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateIdRequest;
use App\Models\Block;
use App\Models\Template;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $templates = Template::whereNull('template_id')->get();
        $pageTemplates = $templates->where('type', 'page');
        $menuTemplates = $templates->where('type', 'menu');
        $generalTemplates = $templates->where('type', 'general');

        return view('templates.index', compact(['pageTemplates', 'menuTemplates', 'generalTemplates']));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemplateRequest  $request
     */
    public function store(StoreTemplateRequest $request)
    {

        $fields = $request->validated();

        if($request->file('image')) {
            $image = $request->file('image');
            $filename = $fields['slug'].'.'.$image->getClientOriginalExtension();
            $folder = 'template';
            Storage::disk('public')->putFileAs($folder, $image, $filename);
            $fields['image'] = asset("storage/$folder/$filename");
        }

        $template = Template::create($fields);

        if($template->type=='general') {
            Block::create([
                'type' => 'general',
                'template_id' => $template->id
            ]);
        }

        return to_route('templates.edit', compact(['template']))
            ->with(['message' => 'Template was created', 'type' => 'success']);
    }

    public function addSubTemplate(TemplateIdRequest $request)
    {
        Template::create($request->validated());
        $template = Template::find($request->parent_template_id);
        return to_route('templates.edit', compact(['template']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     */
    public function edit(Template $template)
    {
        $template = Template::where('id', $template->id)->with('template')->first();
        return view('templates.edit', compact(['template']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemplateRequest  $request
     * @param  \App\Models\Template  $template
     */
    public function update(UpdateTemplateRequest $request, Template $template)
    {
        $fields = $request->validated();
        $fieldsArray = $fields['fields'];
        unset($fields['fields']);

        if($request->file('image')) {
            $image = $request->file('image');
            $filename = $fields['slug'].'.'.$image->getClientOriginalExtension();
            $folder = 'template';
            Storage::disk('public')->putFileAs($folder, $image, $filename);
            $fields['image'] = asset("storage/$folder/$filename");
        }

        $template->update($fields);
        $updateTemplateFieldArray = [];
        foreach($fieldsArray as $id => $array) {
            $array = array_values($array);
            $updateTemplateFieldArray[] = ['id' => $id, 'fields' => json_encode($array)];
        }
        \Batch::update(new Template, $updateTemplateFieldArray, 'id');

        return to_route('templates.edit', compact(['template']))
            ->with(['message' => 'Changes was saved', 'type' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return to_route('templates.index')
            ->with(['message' => 'Template was deleted', 'type' => 'danger']);
    }
}
