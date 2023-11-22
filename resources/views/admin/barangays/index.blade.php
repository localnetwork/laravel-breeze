<x-app-layout>
    @seoTitle('Profile')
    @seoDescription('Become the Splade expert!')
    @seoKeywords('laravel, splade, course')
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="max-w-[25%] w-full flex justify-start flex-col">
                    @include('admin.navigation.admin-sidebar')
                </div>
                <div class="max-w-[75%] w-full">
                    <div class="bg-white p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                        <h1 class="text-xl mb-[20px] font-medium text-gray-900">Management - Barangays</h1>
                        <Link href="#createModal" class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[var(--primaryColor)] hover:bg-[#009945] text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200">Add barangay</Link> 
                        <x-splade-table :for="$barangays" pagination-scroll="head"> 
                            @cell('action', $barangay)
                                <x-splade-link class="items-center block px-4 py-2 text-left text-sm leading-5 text-white border rounded-md shadow-sm bg-[var(--primaryColor)] hover:bg-[#009945] font-medium focus:border-indigo-300 focus:ring-indigo-200 focus:outline-none focus:bg-indigo-700 transition duration-150 ease-in-out" href="#editModal-{{  $barangay->id }}" method="PUT" data="{{ $barangay }}">EDIT</x-splade-link> 

                                <x-splade-link
                                class="items-center block px-4 py-2 text-left text-sm leading-5 text-[red] ml-[5px] hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" 
                                href="{{ route('admin.barangays.destroy', $barangay) }}"
                                confirm="Are you sure want to delete {{ $barangay->name }}?"
                                confirm-button="Yes, delete it."
                                cancel-button="Cancel"
                                method="DELETE" 
                                :data="['_method'=>'DELETE']"
                                > DELETE </x-splade-link>

                                <x-splade-modal name="editModal-{{  $barangay->id }}" id="editModal-{{  $barangay->id }}" :close-button="true" max-width="xl" close-explicitly>
                                    <div class="container">
                                        <h2 class="text-lg font-medium text-gray-900">Edit {{ $barangay->name }}</h2>
                                            {{-- {{  $barangay->id }} --}}
                                
                                        <x-splade-form method="put" :default="$barangay" :action="route('admin.barangays.update', $barangay->id)" class="mt-6 space-y-6" preserve-scroll>
                                            
                                            <x-splade-input  type="text" label="Name" name="name" id="name" class="form-control" />
                                
                                            <div class="flex items-center gap-4">
                                                <x-splade-submit :label="__('Save')" />
                                            </div>
                                        </x-splade-form>
                                    </div>
                                </x-splade-modal>   
                            @endcell
                        </x-splade-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <x-splade-modal name="createModal" id="createModal" :close-button="true" max-width="xl" close-explicitly>
        <div class="container">
            <h2 class="text-lg font-medium text-gray-900">Add a barangay</h2>
    
            <x-splade-form method="POST" :action="route('admin.barangays.store')" class="mt-6 space-y-6" preserve-scroll>
            
                <x-splade-input type="text" label="Name" name="name" id="name" class="form-control" />
   
                <div class="flex items-center gap-4">
                    <x-splade-submit :label="__('Add')" />
        
                    @if (session('status') === 'barangay-updated')
                        <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </x-splade-form>
        </div>  
    </x-splade-modal> 
 </x-app-layout>
