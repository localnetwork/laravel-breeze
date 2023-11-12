@push('styles')
<link rel="stylesheet" href="{{ asset('css/hero-banner.css') }}">
@endpush

<section class="relative bg-black"><span class="HeroBanner_overlay__zR7s5 absolute top-0 left-0 w-full h-full z-[2]"></span>
    <div class="video-container absolute top-0 left-0 w-full h-full z-[1]">
        <video class="h-full w-full object-cover" autoplay="" loop="" muted="" playsinline="">
            <source src="/videos/hero_vid.mp4" type="video/mp4">
        </video>
    </div>
    <div class="min-h-[80vh] relative z-[3] max-w-[1200px] px-[50px] py-[100px] flex flex-col justify-end">
        <h2 class="text-[96px] font-extrabold text-white">Making everyday green, possible.</h2>
        <div class="flex pt-[80px] items-center gap-[20px] font-bold text-[20px]">
            <a class="py-[15px] px-[30px] bg-[var(--primaryColor)] text-white inline-block rounded-[5px] hover:opacity-[.9]" href="/">Be Our Partner</a>
            <a class="py-[15px] px-[30px] text-white inline-block border-[2px] rounded-[5px]" href="/about">Know More About Us</a>
        </div>
    </div>
</section>