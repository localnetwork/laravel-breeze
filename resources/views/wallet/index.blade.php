<x-app-layout>
    <x-splade-form method="POST" :action="route('jobs.store')" class="mt-6 space-y-6" preserve-scroll>
            
        <x-splade-textarea label="Job Description" name="job_description" id="job_description" class="form-control" autosize />

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Add')" />
        </div>
    </x-splade-form>
</x-app-layout>