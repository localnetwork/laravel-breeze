<x-app-layout>
    @seoTitle('Jobs')
    @seoDescription('Become the Splade expert!')
    @seoKeywords('laravel, splade, course')

    @php
        $items = [
        [
            'id' => 1,
            'name' => 'Product 1',
            'description' => 'This is product 1.',
            'price' => 100,
        ],
        [
            'id' => 2,
            'name' => 'Product 2',
            'description' => 'This is product 2.',
            'price' => 200,
        ],
        [
            'id' => 3,
            'name' => 'Product 3',
            'description' => 'This is product 3.',
            'price' => 300,
        ],
    ];
    @endphp



    @include('components.user.user-profile-card')

    <x-splade-rehydrate on="job-added">
        <JobListComponent /> 
    </x-splade-rehydrate>

    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            {{-- <div id="test">
                <job-list-component :jobs="{{ $jobs }}"></job-list-component>
            </div> --}}
            
            <div class="row">
                <div class="max-w-[25%] w-full flex justify-start flex-co">
                    @include('components.user.user-sidebar')
                </div>
                <div class="max-w-[75%] w-full">
                    <Link href="#createModal" class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 text-white border-transparent hover:bg-indigo-700 focus:border-indigo-300 focus:ring-indigo-200">Add a task</Link> 
                    <x-splade-table :for="$jobs" pagination-scroll="head"> 
                        @cell('action', $job)
                        <x-dropdown placement="bottom-end">
                            <x-slot name="trigger">
                                <div class="flex items-center text-sm font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                   Select an option
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    Delete
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown> 
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>


    <x-splade-modal name="createModal" id="createModal" :close-button="true" max-width="xl" close-explicitly>
        <div class="container">
            <h2 class="text-lg font-medium text-gray-900">Add a task</h2>
    
            <x-splade-form method="POST" :action="route('jobs.store')" class="mt-6 space-y-6" preserve-scroll @success="$splade.emit('job-added')">
            
                <x-splade-input type="text" label="Title" name="title" id="title" class="form-control" />
                <x-splade-input label="Quantity" name="quantity" id="quantity" class="form-control" />
                {{-- <x-splade-select label="Trees" name="trees" :options="$trees" /> --}}

                <x-splade-select label="Tree" name="tree" id="tree">
                        <option selected disabled readonly value="">Select an option</option>
                        @foreach ($trees as $tree)
                            <option value="{{ $tree->id }}">{{ $tree->name }}</option>
                        @endforeach
                </x-splade-select>


                <x-splade-textarea label="Job Description" name="job_description" id="job_description" class="form-control" autosize />

                <div class="flex items-center gap-4">
                    <x-splade-submit :label="__('Add')" />
                </div>
            </x-splade-form>
        </div>  
    </x-splade-modal> 
</x-app-layout>