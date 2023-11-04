<x-app-layout>
    @seoTitle('Jobs')
    @seoDescription('Become the Splade expert!')
    @seoKeywords('laravel, splade, course')

    @include('components.user.user-profile-card')
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="max-w-[25%] w-full flex justify-start flex-co">
                    @include('components.user.user-sidebar')
                </div>
                <div class="max-w-[75%] w-full">
                    <Link href="#createModal" class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 text-white border-transparent hover:bg-indigo-700 focus:border-indigo-300 focus:ring-indigo-200">Add a task</Link> 
                    <x-splade-table :for="$jobs" pagination-scroll="head"> 
                        @cell('action', $job)
                        <div class="relative inline-block text-left dropdown-container" data-job-id="{{ $job->id }}">
                            <button type="button" data-dropdown-id="{{ $job->id }}" onclick="dropDown(this)" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:border-blue-300 active:bg-gray-100 active:text-gray-700" aria-haspopup="listbox" aria-expanded="true">
                                Select an option
                            </button>
                    
                            <div id="dropdown-menu-{{ $job->id }}" class="dropdown-menu z-[2] w-full origin-top-left absolute left-0 mt-2 hidden rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 dropdown-options" role="listbox" aria-activedescendant="option-0" tabindex="-1" data-job-id="{{ $job->id }}">
                                <ul class="py-1" role="list" aria-label="Dropdown Options">
                                    <li class="text-gray-900 cursor-default select-none relative p-4" role="option" onclick="closeDropdownOnClickLi(this)">
                                        Option 1
                                    </li>
                                    <li class="text-gray-900 cursor-default select-none relative p-4" role="option">
                                        Option 2
                                    </li>
                                    <li class="text-gray-900 cursor-default select-none relative p-4" role="option">
                                        Option 3
                                    </li>
                                </ul>
                            </div>
                        </div> 
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
 
    <script id="testScript">
        function dropDown(button) {
    console.log('clicked!');
    
    // Remove existing event listeners
    document.querySelectorAll('.dropdown-container').forEach((container) => {
        const button = container.querySelector('button');
        const options = container.querySelector('.dropdown-options');

        if (button && options) {
            button.removeEventListener("click", toggleDropdown);
        }
    });

    // Remove the "hidden" class from all dropdown options
    document.querySelectorAll('.dropdown-options').forEach((options) => {
        options.classList.remove("hidden");
    });

    // Add new event listeners
    document.querySelectorAll('.dropdown-container').forEach((container) => {
        const button = container.querySelector('button');
        const options = container.querySelector('.dropdown-options');

        if (button && options) {
            button.addEventListener("click", toggleDropdown);
            // Close the dropdown when clicking outside of it
            document.addEventListener("click", (event) => {
                if (!container.contains(event.target)) {
                    options.classList.add("hidden");
                }
            });
        }
    });
}

function toggleDropdown() {
    console.log('dropdown toggle'); 
    const options = this.nextElementSibling; // Assuming the options are right after the button
    if (options) {
        options.classList.toggle("hidden");
    }
} 

// Function to close the dropdown when an <li> is clicked
    function closeDropdownOnClickLi(liElement) {
    const dropdownContainer = liElement.closest('.dropdown-container');
    const dropdownOptions = dropdownContainer.querySelector('.dropdown-options');
    if (dropdownOptions) {
        dropdownOptions.classList.add("hidden");
    }
} 
        
    </script> 


    <x-splade-modal name="createModal" id="createModal" :close-button="true" max-width="xl" close-explicitly>
        <div class="container">
            <h2 class="text-lg font-medium text-gray-900">Add a task</h2>
    
            <x-splade-form method="POST" :action="route('jobs.store')" class="mt-6 space-y-6" preserve-scroll>
            
                <x-splade-input type="text" label="Title" name="title" id="title" class="form-control" />
                <x-splade-input label="Quantity" name="quantity" id="quantity" class="form-control" />
                {{-- <x-splade-select label="Trees" name="trees" :options="$trees" /> --}}

                <x-splade-select label="Select a tree" name="tree" id="tree">
                        @foreach ($trees as $tree)
                            <option value="{{ $tree->id }}">{{ $tree->name }}</option>
                        @endforeach
                </x-splade-select>


                <x-splade-textarea label="Job Description" name="job_description" id="job_description" class="form-control min-h-[300px]" autosize />

                <div class="flex items-center gap-4">
                    <x-splade-submit :label="__('Add')" />
                </div>
            </x-splade-form>
        </div>  
    </x-splade-modal> 
</x-app-layout>