<x-guest-layout>
    @php
        $account_type = null;
        if (request('account_type') && request('account_type') === 'sponsor') {
            $account_type = 2;
        }elseif(request('account_type') && request('account_type') === 'volunteer') {
            $account_type = 3; 
        }
    @endphp
    
    @include('layouts.partials.header')
    <div class="main-wrapper p-12 bg-white relative">
        <div class="absolute w-full h-full bg-[#f3f3f3] left-0 top-0 max-w-[50%]"></div>
        <div class="container relative">
            
            <div class="overflow-hidden max-w-[1140px] mx-auto bg-white shadow sm:rounded-lg w-full sticky top-[15px]">
                <div class="relative p-[50px] bg-[#00b14f]">
                    <div class="border-[#046831] border-[2px] relative z-[1] flex items-center justify-center mb-[15px] w-[110px] h-[100px] mx-auto bg-[#f3f3f3] rounded-full block">
                        <Link href="/">LOGO</Link>
                    </div>
                    <div class="max-w-[50%] absolute top-0 left-0 w-full h-full p-[50px] bg-[#009945]">
                        {{-- <h1 class="text-[var(--primaryColor)] text-[20px] leading-[32px] font-medium">Cordo Plants.</h1>
                        <img src="/images/register/hero.svg" /> --}}
                    </div>
                    <div class="relative max-w-[100%] w-full p-[50px] rounded-[15px] bg-white font-bold">
                        <div class="mb-[40px]">
                            <span class="text-[#B4B5BC] uppercase">Start for free</span>
                            <h1 class="text-[#0A053D] text-[30px] mt-[5px] mb-[15px]">Sign up to Cordo Plants.</h1>
                            <span class="text-[#B4B5BC] font-normal">
                                Already a member? <Link class="font-bold text-[#00b14f]" href="/login">Login</Link>
                            </span>
                        </div>

                        
                        
                        <x-splade-form :default="['role_id' => $account_type]" action="{{ route('register') }}" class="space-y-4">
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
                    
                                    {{-- <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </Link> --}}
                    
                            <x-splade-submit class="w-full mt-[15px] max-w-[300px] text-center block justify-between items-center bg-[#00b14f] !rounded-[50px] font-semibold text-[20px] text-white !p-[12px] inline-block" :label="__('Register')" />
                        </x-splade-form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-guest-layout>
