<x-app-layout>
    @seoTitle('Jobs')
    @seoDescription('Become the Splade expert!')
    @seoKeywords('laravel, splade, course')

    @include('components.user.user-profile-card')

    

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
                    
                    <div class="flex items-center gap-x-[15px] mb-[30px]">
                        <span class="font-bold text-[20px]">Job Listing:</span> <Link href="#createModal" class="py-[5px] px-[30px] text-[#00b14f] inline-block border-[2px] border-[#00b14f] rounded-[5px]">Create a job</Link> 
                    </div>
                    
                   
                    {{-- {{ Auth::user() }} --}}
                    <x-splade-rehydrate on="job-added">
                        <JobListComponent /> 
                        {{-- @include('components.JobListComponent') --}}
                    </x-splade-rehydrate>
                    {{-- <x-splade-table :for="$jobs" pagination-scroll="head"> 
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
                    </x-splade-table> --}}
                </div>
            </div>
        </div>
    </div>





    <x-splade-modal name="createModal" id="createModal" :close-button="true" max-width="xl" close-explicitly>
        <div class="container">
            <h2 class="text-lg font-medium text-gray-900">Add a task</h2>

            Current Cordo Points: {{ number_format($user_points) }}

            <span class="warning-message mt-[15px] text-[red] hidden">

            </span>
            <x-splade-form 
                method="POST" 
                :action="route('jobs.store')" class="mt-6 space-y-6" preserve-scroll @success="$splade.emit('job-added')">
                <x-splade-input type="number" label="Quantity" name="quantity" id="quantity" class="form-control" onchange="handleSelectChange()" oninput="handleSelectChange()" />
                <x-splade-select label="Tree" name="tree" id="tree" onchange="handleSelectChange()">
                        <option selected disabled readonly value="">Select an option</option>
                        @foreach ($trees as $tree)
                            <option tree_value="{{ $tree->tree_value }}" value="{{ $tree->id }}">{{ $tree->name }}</option>
                        @endforeach
                </x-splade-select> 

                <x-splade-select label="Address" name="address" id="address">
                    <option selected disabled readonly value="">Select an option</option>
                    @foreach ($address as $address)
                        <option value="{{ $address->id }}">{{ $address->name }}</option>
                    @endforeach
                </x-splade-select>
                {{-- <x-splade-textarea label="Job Description" name="job_description" id="job_description" class="form-control" autosize /> --}}

                <div class="flex items-center gap-4">
                    <x-splade-submit :label="__('Add')" />
                </div>

                
            </x-splade-form>
        </div>  
    </x-splade-modal> 

    <script>
        function handleSelectChange() {
            const currentPoints = {{ $user_points }}; 
            const warningMsg = document.querySelector('.warning-message');
            console.log('onChangeee'); 
            var quantityElement = document.getElementById('quantity');
            var selectElement = document.getElementById('tree');
    
            var selectedOption = selectElement.options[selectElement.selectedIndex];
    
            var selectedValue = selectedOption.value;
            var selectedTreeValue = selectedOption.getAttribute('tree_value');

            if (!isNaN(quantityElement.value) && quantityElement.value !== '' && selectedTreeValue !== null) {
                const total = selectedTreeValue * quantityElement.value; 
                if(total > currentPoints) {
                    console.log(total); 
                    warningMsg.classList.add('block'); 
                    warningMsg.classList.remove('hidden'); 
                    warningMsg.innerHTML = "You don't have enough points. <br /> Estimated Total cost is: " + total.toLocaleString() + '.'; 
                }else {
                    warningMsg.classList.remove('block'); 
                    warningMsg.classList.add('hidden'); 
                }
            }else {
                warningMsg.classList.remove('block'); 
                warningMsg.classList.add('hidden');  
            }
        }
    </script>
</x-app-layout>


