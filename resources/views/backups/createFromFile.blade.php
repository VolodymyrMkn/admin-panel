<x-admin.layout title="Created Backup From File">
    <h1>Created Backup From File</h1>
    <x-forms.post action="{{ route('backups.storeFromFile') }}">
        <x-cards.simple size="half" title="Created Backup">
            <x-inputs.input label="Title"/>
            <x-inputs.textarea label="Description"/>
            <x-inputs.file label="File" />
            <x-buttons.submit>Created Backup</x-buttons.submit>
        </x-cards.simple>
    </x-forms.post>
</x-admin.layout>
