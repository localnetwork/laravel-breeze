@php
$menuItems = [
    [
        'title' => 'Profile',
        'link' => '/profile'
    ],
    [
        'title' => 'Manage Listings',
        'link' => '/jobs',
        'role' => 2, 
    ], 
    [
        'title' => 'Manage Events',
        'link' => '/manage/events',
        'role' => 2, 
    ],
    [
        'title' => 'Wallet',
        'link' => '/wallet',
        'not_role' => 3, 
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


    @if(isset($item['role']))
        @if(isset(Auth::user()->role_id) && $item['role'] == Auth::user()->role_id) 
            <div key="{{$index}}" class="border-b-[1px] mb-[15px] pb-[15px] {{ $activeClass }}">
                <Link class="text-[#111827] text-[20px] font-bold {{ Request::is($item['link']) ? 'active' : '' }}" href="{{ $item['link'] }}">{{ $item['title'] }}</Link>
            </div>
        @else
            
        @endif
    @elseif(isset($item['not_role']) && $item['not_role'] != Auth::user()->role_id)
            {{-- DO NOT SHOW LINK IF NOT ROLE --}}
    @else
        <div key="{{$index}}" class="border-b-[1px] mb-[15px] pb-[15px] {{ $activeClass }}">
            <Link class="text-[#111827] text-[20px] font-bold {{ Request::is($item['link']) ? 'active' : '' }}" href="{{ $item['link'] }}">{{ $item['title'] }}</Link>
        </div>
    @endif
    @endforeach
</div>