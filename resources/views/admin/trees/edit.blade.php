{{-- <x-app-layout>
    <div class="container">
        <h1>Edit Tree {{ $tree->name }}</h1>
        <x-splade-form  :default="$tree" method="put" :action="route('admin.trees.update', $tree->id)" class="mt-6 space-y-6" preserve-scroll>
            
            <x-splade-input type="text" label="Name" name="name" id="name" class="form-control" />

            <div class="flex items-center gap-4">
                <x-splade-submit :label="__('Save')" />
    
                @if (session('status') === 'tree-updated')
                    <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </x-splade-form>
    </div>
</x-app-layout> --}}