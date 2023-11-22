<div class="header-user-nav flex justify-end mb-[15px]">
    @if(!isset(Auth::user()->name)) 
        <div class="flex gap-x-[15px] items-center">
            <Link class="py-[5px] px-[30px] text-[var(--primaryColor)] inline-block border-[var(--primaryColor)] border-[2px] rounded-[5px]" href="/login">Login</Link>
            <Link class="py-[5px] inline-block" href="/apply">Register</Link>
        </div>
    @else
        <div class="flex gap-x-[15px] items-center">
            <x-dropdown placement="bottom-end">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                        @if(isset(Auth::user()->name))
                            <div>{{ Auth::user()->name }}</div>
                        @endif
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    @if(isset(Auth::user()->role_id))
                        <x-dropdown-link href="/dashboard">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link as="a" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    @endif
</div>