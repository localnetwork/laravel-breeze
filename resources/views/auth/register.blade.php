<x-guest-layout>
    <x-auth-card>
        <x-splade-form action="{{ route('register') }}" class="space-y-4">
            <x-splade-input id="name" type="text" name="name" :label="__('Name')" autofocus />
            <x-splade-input id="email" type="email" name="email" :label="__('Email')" />
            <x-splade-file  filepond="{ allowDrop: true }" dusk="profile_picture" name="profile_picture" @input="form.profile_picture = $event.target.files[0]" />
            <img class='max-w-[150px]' v-if="form.profile_picture" :src="form.$fileAsUrl('profile_picture')" />
            <p v-text="form.errors.profile_picture" />
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
