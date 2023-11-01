<x-guest-layout>
    <x-auth-card>
        <x-splade-form action="{{ route('register') }}" class="space-y-4">
            <x-splade-input id="name" type="text" name="name" :label="__('Name')" required autofocus />
            <x-splade-input id="email" type="email" name="email" :label="__('Email')" required />
            <input type="file" dusk="avatar" name="profile_picture" @input="form.avatar = $event.target.files[0]" />
            <p v-text="form.errors.avatar" />
            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="new-password" />
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required />

            <div class="flex items-center justify-end">
                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </Link>

                <x-splade-submit class="ml-4" :label="__('Register')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
