<x-app-layout>
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="max-w-[25%] w-full flex justify-start flex-col">
                    @include('admin.navigation.admin-sidebar')
                </div>
                <div class="max-w-[75%] w-full">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h1 class="text-xl mb-[20px] font-medium text-gray-900">Management - Trees</h1>
                            <Link href="#treeModal" class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[var(--primaryColor)] hover:bg-[#009945] text-white border-transparent  focus:border-indigo-300 focus:ring-indigo-200">Add tree</Link> 
                            <x-splade-table :for="$trees" pagination-scroll="head"> 
                                @cell('action', $tree)
                                    <x-splade-link class="items-center block px-4 py-2 text-left text-sm leading-5 text-white border rounded-md shadow-sm bg-[var(--primaryColor)] hover:bg-[#009945] font-medium focus:border-indigo-300 focus:ring-indigo-200 focus:outline-none focus:bg-indigo-700 transition duration-150 ease-in-out" href="#editModal-{{  $tree->id }}" method="PUT" data="{{ $tree }}" :data="['tree' => 'Untitled Template']">EDIT</x-splade-link> 

                                    <x-splade-link
                                    class="items-center block px-4 py-2 text-left text-sm leading-5 text-[red] ml-[5px] hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" 
                                    href="{{ route('admin.trees.destroy', $tree) }}"
                                    confirm="Are you sure want to delete {{ $tree->name }}?"
                                    confirm-button="Yes, delete it."
                                    cancel-button="Cancel"
                                    method="DELETE" 
                                    :data="['_method'=>'DELETE']"
                                    > DELETE </x-splade-link>



                                    <x-splade-modal name="editModal-{{  $tree->id }}" id="editModal-{{  $tree->id }}" :close-button="true" max-width="xl" close-explicitly>
                                        <div class="container">
                                            <h2 class="text-lg font-medium text-gray-900">Edit {{ $tree->name }}</h2>
                                
                                    
                                            <x-splade-form method="put" :default="$tree" :action="route('admin.trees.update', $tree->id)" class="mt-6 space-y-6" preserve-scroll>
                                                
                                                <x-splade-input  type="text" label="Name" name="name" id="name" class="form-control" />

                                                <x-splade-input  step="10" type="number" label="Tree value" name="tree_value" id="tree_value" class="form-control" />
                                    
                                                <input type="hidden" name="tree_id" id="tree_id" :value="treeId" />
                                    
                                                <div class="flex items-center gap-4">
                                                    <x-splade-submit :label="__('Save')" />
                                    
                                                    @if (session('status') === 'tree-updated')
                                                        <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                                    @endif
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
    </div>


    <x-splade-modal name="treeModal" id="treeModal" :close-button="true" max-width="xl" close-explicitly>
        <div class="container">
            <h2 class="text-lg font-medium text-gray-900">Add a tree</h2>
    
            <x-splade-form method="POST" :action="route('admin.trees.store')" class="mt-6 space-y-6" preserve-scroll>
            
                <x-splade-input type="text" label="Name" name="name" id="name" class="form-control" />

                <x-splade-input  step="10" type="number" label="Tree value" name="tree_value" id="tree_value" class="form-control" />
    
                <div class="flex items-center gap-4">
                    <x-splade-submit :label="__('Add')" />
        
                    @if (session('status') === 'tree-updated')
                        <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </x-splade-form>
        </div>  
    </x-splade-modal> 
 </x-app-layout>
