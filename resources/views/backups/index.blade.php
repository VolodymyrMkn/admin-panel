<x-admin.layout title="Backups">
    <h1>Backups</h1>
    <x-tables.simple
        :labels="['Title', 'Date']"
        :fields="['title', 'created_at']"
        :models="$backups"
        noSort="1"
        title="Backups"/>

    <x-buttons.add-link link="{{ route('backups.create') }}">Created Backups</x-buttons.add-link>
    <x-buttons.add-link link="{{ route('backups.createFromFile') }}">Created From File</x-buttons.add-link>
</x-admin.layout>
