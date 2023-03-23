@props ([
    'first' => null,
    'template',
    'model'
])


<x-template.fields :fields="$template->fields" :model="$template" :$first />
<input type="text" form="addSubTemplate" name="template_id" value="{{ $template->id }}" hidden>

@if($template->template)

    <x-template.level :fields="$template->template->fields" :template="$template->template" :model="$template"/>
@endif
