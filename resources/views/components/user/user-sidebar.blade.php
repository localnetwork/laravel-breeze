@php
$menuItems = [
    [
        'title' => 'Profile',
        'link' => '/profile'
    ],
    [
        'title' => 'Manage Listings',
        'link' => '/jobs'
    ], 
    [
        'title' => 'Manage Events',
        'link' => '/manage/events'
    ],
    [
        'title' => 'Wallet',
        'link' => '/wallet'
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
            <Link class="text-[#111827] text-[20px] font-bold {{ Request::is($item['link']) ? 'active' : '' }}" href="{{ $item['link'] }}">{{ $item['title'] }}</Link>
        </div>
    @endforeach
</div>