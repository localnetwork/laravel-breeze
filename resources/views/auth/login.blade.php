<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('login') }}" class="space-y-4">
            <!-- Email Address -->
            <x-splade-input id="email" type="email" name="email" :label="__('Email')" autofocus />
            <x-splade-input id="password" type="password" name="password" :label="__('Password')" autocomplete="current-password" />
            <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" />

            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                    <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </Link>
                @endif

                <x-splade-submit class="ml-3" :label="__('Log in')" />
            </div>

            <div class="mt-[15px] border-t-[1px] pt-[30px] border-color-[#ccc]">
                @if (Route::has('register'))
                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('New to the site? Create an account.') }}
                </Link>
            @endif
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
