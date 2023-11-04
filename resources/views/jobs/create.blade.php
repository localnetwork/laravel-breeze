<x-app-layout title="Create Job">
    <x-splade-form action="{{ route('jobs.store') }}" method="POST">
        @csrf

        <x-splade-input name="title" label="Title" required />
        {{-- <x-splade-select name="user_id" label="User" :options="$users" required /> --}}
        {{  dd($user_id) }}
        <x-splade-input name="user_id" type="number" label="User ID" required value="$user_id" />
        <x-splade-input type="number" name="quantity" label="Quantity" required />
        <x-splade-textarea name="job_description" label="Job Description" required />

        <x-splade-button>Create Job</x-splade-button>
    </x-splade-form>
</x-app-layout>