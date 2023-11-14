@php
$menuItems = [
    [
        'title' => 'Home',
        'link' => '/'
    ],
    [
        'title' => 'About',
        'link' => '/about'
    ],
    [
        'title' => 'Contact',
        'link' => '/contact'
    ],

]; 
@endphp



<header class="header py-[20px] bg-white">
    <div class="container mx-auto">
        <div class="row justify-between items-center mx-[-15px]">
            <div class="nav-logo">
                <Link href='/'>
                    <div class="h-[70px] w-[70px] rounded-full inline-flex items-center justify-center bg-[#f3f3f3]">Logo</div>
                </Link>
            </div>  
            <div class=""> 
                @include('layouts.partials.header-user-nav')
                <div class="menu text-[20px] gap-[30px] flex items-center font-bold flex gap-[15px]">
                    @foreach($menuItems as $index => $item)
                        @php
                            if(Request::path() === '/')  {
                                $linkUrl = $item['link'];
                            }else {
                                $linkUrl = ltrim($item['link'], '/');
                            }

                            if (Request::path() == $linkUrl) {
                                $activeClass = 'disabled text-[var(--primaryColor)]'; 
                            }else {
                                $activeClass = 'not-active'; 
                            }
                        @endphp

                        <div key="{{$index}}">
                            <Link class="{{  $activeClass }} hover:text-[var(--primaryColor)] {{ Request::is($item['link']) ? 'active' : '' }}" href="{{ $item['link'] }}">{{ $item['title'] }}</Link>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>