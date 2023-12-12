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
                            <h1 class="text-xl mb-[20px] font-medium text-gray-900">Management - Users</h1>
                            <Link href="#userModal" class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[var(--primaryColor)] hover:bg-[#009945] text-white border-transparent  focus:border-indigo-300 focus:ring-indigo-200">Add a user</Link> 
                            <x-splade-table :for="$users" pagination-scroll="head"> 
                                @cell('action', $user)
                                    {{  $user }}
                                @endcell 
                            </x-splade-table>
                            {{-- <x-splade-table :for="$users" pagination-scroll="head"> 
                                @cell('action', $user)
                                    <x-splade-link class="items-center block px-4 py-2 text-left text-sm leading-5 text-white border rounded-md shadow-sm bg-[var(--primaryColor)] hover:bg-[#009945] font-medium focus:border-indigo-300 focus:ring-indigo-200 focus:outline-none focus:bg-indigo-700 transition duration-150 ease-in-out" href="#editModal-{{  $users->id }}" method="PUT" data="{{ $users }}">EDIT</x-splade-link> 

                                    <x-splade-link
                                    class="items-center block px-4 py-2 text-left text-sm leading-5 text-[red] ml-[5px] hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" 
                                    href="{{ route('admin.trees.destroy', $users) }}"
                                    confirm="Are you sure want to delete {{ $users->name }}?"
                                    confirm-button="Yes, delete it."
                                    cancel-button="Cancel"
                                    method="DELETE" 
                                    :data="['_method'=>'DELETE']"
                                    > DELETE </x-splade-link>



                                    <x-splade-modal name="editModal-{{  $users->id }}" id="editModal-{{  $users->id }}" :close-button="true" max-width="xl" close-explicitly>
                                        <div class="container">
                                            <h2 class="text-lg font-medium text-gray-900">Edit {{ $users->name }}</h2>
                                
                                    
                                            <x-splade-form method="put" :default="$users" :action="route('admin.trees.update', $users->id)" class="mt-6 space-y-6" preserve-scroll>
                                                
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
                            </x-splade-table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-splade-modal name="userModal" id="userModal" :close-button="true" max-width="xl" close-explicitly>
        <div class="container">
            <h2 class="mb-[30px] text-lg font-medium text-gray-900">Add a user</h2>
            <x-splade-form action="{{ route('register') }}" class="space-y-4">
                <div class="mb-[30px] step bg-[#f3f3f3] p-[30px] pt-[5px] rounded-[15px] relative">
                    <span class="border-[5px] border-color-[#f3f3f3] flex items-center justify-center absolute w-[50px] h-[50px] text-[18px] text-white top-[-15px] bg-[#00b14f] rounded-full text-center font-bold">1</span>
                    <h2 class="text-[#280031] text-[20px] font-bold pl-[60px] mb-[10px]">Provide your profile information.</h2>
                    <x-splade-group validation-key="role_id" class="account-type mb-[15px]" id="role_id" name="role_id" label="Account Type" inline required>
                        <x-splade-radio  name="role_id" value="2" label="Sponsor">
                            Sponsor
                        </x-splade-radio>
                        <x-splade-radio  name="role_id" value="3" label="Volunteer" />
                    </x-splade-group>

                        <div class="flex mb-[15px] gap-x-[15px]">
                        <x-splade-input placeholder="Enter your name" class="max-w-[50%] w-full" id="name" type="text" name="name" :label="__('Name')" />
                        <x-splade-input placeholder="Enter your shortname" class="max-w-[50%] w-full" id="short_name" type="text" name="short_name" :label="__('Short Name')" />
                    </div>


                    <x-splade-select class="mb-[15px]" label="Address" name="address" id="address">
                            <option selected disabled readonly value="">Select an option</option>
                            @foreach ($address as $barangay)
                                <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                            @endforeach
                    </x-splade-select>

                    <x-splade-file class="mb-[15px]" label="Profile Picture" filepond="{ allowDrop: true }" dusk="profile_picture" name="profile_picture" @input="form.profile_picture = $event.target.files[0]" />
                    
                    <x-splade-file class="mb-[15px]" label="Cover Photo"  filepond="{ allowDrop: true }" dusk="cover_photo" name="cover_photo" @input="form.cover_photo = $event.target.files[0]" /> 
                    <x-splade-wysiwyg class="hide-editor-toolbar" label="Bio" name="bio" id="bio" jodit="{ showXPathInStatusbar: true }" />
                </div>        
                
                <div class="step bg-[#f3f3f3] p-[30px] pt-[5px] rounded-[15px] relative">
                    <span class="border-[5px] border-color-[#f3f3f3] flex items-center justify-center absolute w-[50px] h-[50px] text-[18px] text-white top-[-15px] bg-[#00b14f] rounded-full text-center font-bold">2</span>
                    <h2 class="text-[#280031] text-[20px] font-bold pl-[60px] mb-[15px]">Provide your account information.</h2>
                    <x-splade-input class="mb-[15px]" id="email" type="email" name="email" :label="__('Email')" />
                    <x-splade-input class="mb-[15px]" id="password" type="password" name="password" :label="__('Password')" autocomplete="new-password" />
                    <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" />
                </div>
                <x-splade-submit class="w-full mt-[15px] max-w-[300px] text-center block justify-between items-center bg-[#00b14f] !rounded-[50px] font-semibold text-[20px] text-white !p-[12px] inline-block" :label="__('Register')" />
            </x-splade-form>
        </div>  
    </x-splade-modal> 
 </x-app-layout>
