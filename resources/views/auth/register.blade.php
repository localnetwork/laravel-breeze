<x-guest-layout>
    <x-auth-card>
        <x-splade-form action="{{ route('register') }}" class="space-y-4">

            <x-splade-group class="account-type" id="role_id" name="role_id" label="Account Type" inline>
                <x-splade-radio name="role_id" value="2" label="Sponsor">
                    TEST
                </x-splade-radio>
                <x-splade-radio name="role_id" value="3" label="Volunteer" />
            </x-splade-group>


            <x-splade-input id="name" type="text" name="name" :label="__('Name')" autofocus />
            <x-splade-input id="short_name" type="text" name="short_name" :label="__('Short Name')" />
            <x-splade-wysiwyg class="hide-editor-toolbar" name="bio" label="Bio" jodit="{ showXPathInStatusbar: false }" />

            <x-splade-input id="email" type="email" name="email" :label="__('Email')" />

            
            
            <x-splade-file  label="Profile Picture" filepond="{ allowDrop: true }" dusk="profile_picture" name="profile_picture" @input="form.profile_picture = $event.target.files[0]" />
            {{-- <img class='max-w-[150px]' v-if="form.profile_picture" :src="form.$fileAsUrl('profile_picture')" /> --}}
            
            <x-splade-file label="Cover Photo"  filepond="{ allowDrop: true }" dusk="cover_photo" name="cover_photo" @input="form.cover_photo = $event.target.files[0]" />
            {{-- <img class='h-[100px] w-[100px] object-contain bg-[#000]' v-if="form.cover_photo" :src="form.$fileAsUrl('cover_photo')" /> --}}


            <x-splade-input id="password" type="password" name="password" :label="__('Password')" autocomplete="new-password" />
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" />

            <div class="flex items-center justify-end">
                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </Link>

                <x-splade-submit class="ml-4" :label="__('Register')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
