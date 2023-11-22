<x-app-layout>
    @include('components.user.user-profile-card')
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="w-full max-w-[25%] w-full flex justify-start flex-co">
                    @include('components.user.user-sidebar')
                </div>
                <div class="w-full  max-w-[75%]">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full sticky top-[15px]">
                        @if(isset(Auth::user()->role_id) && Auth::user()->role_id == 2) 
                            @include('wallet.topup-form') 
                        @elseif(isset(Auth::user()->role_id) && Auth::user()->role_id == 3)
                            @include('wallet.withdrawal-form') 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>