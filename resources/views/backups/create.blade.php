<x-admin.layout title="Created Backup">
    <h1>Created Backup</h1>
    <x-forms.post action="{{ route('backups.store') }}">
        <x-cards.simple size="half" title="Created Backup">
            <x-inputs.input label="Title"/>
            <x-inputs.textarea label="Description"/>
            <x-buttons.submit>
                Created Backup
            </x-buttons.submit>
        </x-cards.simple>
    </x-forms.post>
</x-admin.layout>
