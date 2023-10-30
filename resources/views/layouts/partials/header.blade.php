@php
$menuItems = [
    [
        'title' => 'Home',
        'link' => '/'
    ],
    [
        'title' => 'About',
        'link' => '/about'
    ]  
]; 
@endphp

<header class="header py-[20px] bg-white sticky top-0 z-[222]">
    <div class="container mx-auto">
        <div class="row justify-between items-center mx-[-15px]">
            <div class="nav-logo">
                <Link href='/' >
                    <div class="h-[70px] w-[70px] rounded-full inline-flex items-center justify-center bg-[#f3f3f3]">Logo</div>
                </Link>
            </div>  
            <div class="nav-menu"> 
                <div class="flex gap-[15px]">
                    @foreach($menuItems as $item)
                        <div class="">
                            <Link href="{{ $item['link'] }}">{{ $item['title'] }}</Link>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>