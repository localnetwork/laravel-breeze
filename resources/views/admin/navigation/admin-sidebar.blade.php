@php
$menuItems = [
    [
        'title' => 'Dashboard',
        'link' => '/dashboard',
        'icon' => '/images/icons/dashboard.svg',
    ],
    [
        'title' => 'Trees',
        'link' => '/admin/trees',
        'icon' => '/images/icons/tree.svg',
    ],
    [
        'title' => 'Jobs Transactions',
        'link' => '/admin/job-transactions',
        'icon' => '/images/icons/job.svg',
    ],
    [
        'title' => 'Barangays',
        'link' => '/admin/barangays',
        'icon' => '/images/icons/building.svg',
    ],
    [
        'title' => 'Point Transactions',
        'link' => '/admin/points-transactions',
        'icon' => '/images/icons/money.svg',
    ],
    [
        'title' => 'Contact Submissions',
        'link' => '/admin/contact',
        'icon' => '/images/icons/form.svg',
    ],
    [
        'title' => 'Users',
        'link' => '/admin/users',
        'icon' => '/images/icons/form.svg',
    ],
]; 
@endphp

<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full sticky top-[15px]">
    {{-- <h2>Sidebar </h2> --}}
    @foreach($menuItems as $index => $item)

    @php
        $linkUrl = ltrim($item['link'], '/');
    @endphp

    @if (Request::path() == $linkUrl)
        @php
            $activeClass = 'opacity-[.7] disabled'; 
        @endphp
    @else
        @php
            $activeClass = 'not-active'; 
        @endphp
    @endif


   
    <div key="{{$index}}" class="border-b-[1px] mb-[15px] pb-[15px] {{ $activeClass }}">
        
        <Link class="flex items-center gap-x-[15px] text-[#111827] text-[20px] font-bold {{ Request::is($item['link']) ? 'active' : '' }}" href="{{ $item['link'] }}">
            @if(isset($item['icon']))
                <img width="25" height="25" src="{{ $item['icon'] }}" loading="lazy" />
            @endif
            {{ $item['title'] }}
        </Link>
    </div>
    @endforeach


    <form class="mt-[100px]" method="POST" action="{{ route('logout') }}"  >
        @csrf

        <x-dropdown-link class="!inline-flex !items-center !p-0 !bg-[transparent] !gap-x-[15px] !text-[#111827] !text-[20px] !font-bold" as="a" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            <img width="25" height="25" src="/images/icons/logout.svg" loading="lazy" />
            
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</div>