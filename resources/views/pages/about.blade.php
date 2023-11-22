@section('title', 'Example Page Title')

<x-app-layout>
    
    <div class="relative py-[100px]">
        <span class="bg-[#F9F6F6] absolute bottom-0 h-[60%] w-[100%] z-[-1]"></span>
        <div class="max-w-[90vw] mx-auto">
            <h1 class="text-[var(--textPrimary)] text-[6rem] max-w-[960px] font-semibold mb-[70px] leading-[6.5rem]">Planting forward together</h1>
            <img src="/images/about/hero.jpg" />
            <div class="p-[100px] bg-white text-center"><h2 class="text-[2.25rem] leading-[2.75rem]">Guided by the experts, our mission is to drive Cordova forward by creating economic empowerment for everyone.</h2></div>
        </div>
    </div>

    <div class="cta bg-[var(--primaryColor)] text-[20px] font-bold text-white items-center px-[50px] py-[30px]">
        <div class="max-w-[90vw] mx-auto"> Read A Letter From Our Founders</div>
    </div>
    <div class="">
        <div class="flex item flex-wrap  max-w-[90vw] mx-auto py-[80px]">
            <div class="text-[#383e43] w-full text-[1.5rem] max-w-[50%]">Creating the superapp</div>
            <div class="w-full max-w-[50%]">
                <h2 class="text-[3rem] leading-[3.5rem] text-[#242a2e] font-bold">Millions of people use Grab for many moments in their everyday lives.</h2>

                <div class="my-[50px]">
                    <a href="#" class="text-[#00804a] font-semibold leading-[1.75rem] text-[1.25rem]">See How We Do It</a>
                </div>

                <img src="/images/about/coLanding-section-01-d.png" class="w-full h-auto" width="600" height="600" />
            </div>
        </div>

        <div class="divider max-w-[90vw] my-[30px] mx-auto border-[1px] border-[#242a2e]"></div>

        <div class="flex item flex-wrap max-w-[90vw] mx-auto py-[80px]">
            <div class="text-[#383e43] w-full text-[1.5rem] max-w-[50%]">Creating the superapp</div>
            <div class="w-full max-w-[50%]">
                <h2 class="text-[3rem] leading-[3.5rem] text-[#242a2e] font-bold">Millions of people use Grab for many moments in their everyday lives.</h2>

                <div class="my-[50px]">
                    <a href="#" class="text-[#00804a] font-semibold leading-[1.75rem] text-[1.25rem]">See How We Do It</a>
                </div>
            </div>
            <div class="w-full max-w-full pb-[41.86047%] relative">
                <img src="/images/about/coLanding-section-01-d.png" class="w-full h-full absolute object-cover" width="600" height="600" />
            </div>
        </div>

        <div class="divider max-w-[90vw] my-[30px] mx-auto border-[1px] border-[#242a2e]"></div>


        <div class="flex item flex-wrap  max-w-[90vw] mx-auto py-[80px]">
            <div class="text-[#383e43] w-full text-[1.5rem] py-[50px]">Our guiding principles</div>
            <div class="max-w-[50%] w-full pr-[100px]">
                <img src="/images/about/coLanding-section-01-d.png" class="w-full h-auto" width="600" height="600" />
            </div>
            <div class="w-full max-w-[50%]">
                <h2 class="text-[3rem] leading-[3.5rem] text-[#242a2e] font-bold">Strong corporate governance principles help us stay true to our mission.</h2>
                <div class="my-[50px]">
                    <a href="#" class="text-[#00804a] font-semibold leading-[1.75rem] text-[1.25rem]">Learn What Guides Us</a>
                </div>
            </div>
            <div class="w-full relative pb-[41.86047%] mt-[100px]">
                <img class="absolute h-full w-full object-cover" src="/images/about/coLanding-section-04-d.png" width="600" height="600" />
            </div>
        </div>
        @if(!Auth::user())
        <div class="max-w-[90vw] mx-auto py-[80px]">
            <h2 class="text-[3rem] leading-[3.5rem] text-[#242a2e] font-bold mb-[30px]">Join Us</h2>
            <div class="flex gap-x-[50px]">
                <Link href="/register?account_type=sponsor" class="max-w-[50%] w-full min-w-[300px] inline-flex justify-center items-center bg-[#00b14f] rounded-[50px] font-semibold text-[25px] text-white p-[32px] inline-block">Be Our Sponsor</Link>
                <Link href="/register?account_type=volunteer" class="max-w-[50%] w-full min-w-[300px] justify-center inline-flex items-center text-[#005339] rounded-[50px] bg-[#eef9f9] font-semibold text-[25px] p-[32px] ">Be Our Volunteer</Link>
            </div>
        </div>
        @endif

    </div>
    
</x-app-layout>