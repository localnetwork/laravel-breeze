<x-guest-layout>
    @include('layouts.partials.header')
    <div class="main-wrapper relative py-12 bg-[#FBFBFB]">
        <div class="relative">
        <x-auth-session-status class="mb-4" />
        <div class="flex shadow-xl border-[1px] border-[#f3f3f3] rounded-[10px] overflow-hidden !px-[0] container">
            <div class="max-w-[50%] bg-[#FAFBFC] w-full p-[50px]">
                <div class="text-[#0A053D] text-[30px] mt-[5px] mb-[15px] font-bold">Cordo Plants</div>
                <span class="mb-[30px] block text-[#B4B5BC] font-normal max-w-[370px]">A central hub where sponsors and volunteers achieve amazing things together.</span>
                <img class="w-full" src="/images/register/hero.svg" />
            </div>
            <div class="login-content bg-white max-w-[50%] w-full p-[50px] flex flex-col items-center">
                <div class="w-full">
                    <h1 class="font-bold text-[#344055] text-[30px] mt-[5px] mb-[15px]">Login to Cordo Plants.</h1>
                    <div class="mb-[30px] block text-[#B4B5BC] font-normal max-w-[370px]">Not a member? 
                        <Link class="text-[#00b14f]" href="/register">
                            Register
                        </Link>
                    </div>
                    <x-splade-form action="{{ route('login') }}" class="w-full space-y-4">
                        <!-- Email Address -->
                        <x-splade-input id="email" type="email" name="email" :label="__('Email')" autofocus />
                        <x-splade-input id="password" type="password" name="password" :label="__('Password')" autocomplete="current-password" />
                        <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" />
            
                        <div class="flex items-center">
                            <x-splade-submit class="border min-w-[250px] rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 w-full mt-[15px] max-w-[300px] text-center block justify-between items-center bg-[#00b14f] !rounded-[50px] font-semibold text-[20px] text-white !p-[12px] inline-block" :label="__('Log in')" />
                        </div>
            
                        <div class="mt-[15px] border-t-[1px] pt-[30px] border-color-[#ccc]">
                            {{-- @if (Route::has('register'))
                            <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                                {{ __('New to the site? Create an account.') }}
                            </Link>
                        @endif --}}
                        @if (Route::has('password.request'))
                                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </Link>
                            @endif
                        </div>
                    </x-splade-form> 
                </div>
            </div>
        </div>
        </div>
    </div>
    @include('layouts.partials.footer')
</x-guest-layout>
