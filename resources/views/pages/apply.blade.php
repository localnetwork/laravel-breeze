@section('title', 'Example Page Title')

<x-app-layout>
    <div class="flex px-[50px]">
        <div class="flex flex-col justify-end">
            <p class="text-[1.5rem] leading-[2rem] ">Cordo-Partner</p>
            <h1 class="text-[var(--textPrimary)] text-[6rem] max-w-[960px] font-semibold mb-[70px] leading-[6.5rem]">Make someone’s day by planting.</h1>
            <h3 class="text-[1.5rem] leading-[2rem] mb-[30px] font-bold text-[#005339]">Register As</h3>
            <div class="flex gap-[20px]"><div><a class="min-w-[300px] inline-flex justify-between items-center bg-[#00b14f] rounded-[50px] font-semibold text-[25px] text-white p-[32px] inline-block" href="/">Sponsor<span class="ml-[20px]"><svg class="hero-cta-arrow___3RvtT" width="24" height="24" xmlns="http://www.w3.org/2000/svg"> <g clip-path="url(#prefix__clip0_132_30)"> <path fill="#fff" clip-rule="evenodd" d="M18.755 12.75H3.75a.75.75 0 010-1.5h15.006l-5.473-5.473a.748.748 0 111.058-1.058l6.22 6.22a1.5 1.5 0 010 2.12l-6.223 6.223a.748.748 0 01-1.058-1.058l5.475-5.474z"></path> </g> <defs> <clipPath id="prefix__clip0_132_30"> <path d="M0 0h24v24H0z"></path> </clipPath> </defs> </svg></span></a></div><div><a class="min-w-[300px] justify-between inline-flex items-center text-[#005339] rounded-[50px] bg-[#eef9f9] font-semibold text-[25px] p-[32px] " href="/">Volunteer<span class="ml-[20px]"><svg class="hero-cta-arrow___3RvtT" width="24" height="24" xmlns="http://www.w3.org/2000/svg"> <g clip-path="url(#prefix__clip0_132_30)"> <path fill="#005339" clip-rule="evenodd" d="M18.755 12.75H3.75a.75.75 0 010-1.5h15.006l-5.473-5.473a.748.748 0 111.058-1.058l6.22 6.22a1.5 1.5 0 010 2.12l-6.223 6.223a.748.748 0 01-1.058-1.058l5.475-5.474z"></path> </g> <defs> <clipPath id="prefix__clip0_132_30"> <path d="M0 0h24v24H0z"></path> </clipPath> </defs> </svg></span></a></div></div>
        </div>
        <div class="max-w-[50%] pl-[50px]">
            <img class="w-full h-[800px] object-cover" src="/images/apply/apply_banner.jpg" width="600" height="400"/>
        </div>
    </div> 
</x-app-layout>