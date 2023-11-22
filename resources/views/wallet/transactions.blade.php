<x-app-layout>
    @include('components.user.user-profile-card')
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="w-full max-w-[25%] flex justify-start flex-col">
                    @include('components.user.user-sidebar')
                </div>
                <div class="w-full max-w-[75%]">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full sticky top-[15px]">
                        <div class="flex mb-[50px] flex-wrap justify-between">
                            <h1 class="text-[40px] leading-[32px] font-medium text-gray-900"><h1 class="text-[40px] leading-[32px] font-medium text-gray-900">{{  isset(Auth::user()->role_id) && Auth::user()->role_id == 2 ? 'My Purchases' : 'My Withdrawals' }}</h1></h1>
                            <Link href="/wallet">Go back to wallet</Link>
                        </div>
                        
                        <x-splade-table 
                            :for="$transactions">

                            @cell('payment_method', $transaction)
                                @php
                                    $transaction_paymentMethod = App\Models\PaymentMethod::find($transaction->payment_method);
                                @endphp

                                {{  $transaction_paymentMethod->title }}
                            @endcell

                            @cell('proof', $transaction)
                                <img width="100" height="100" src="{{ asset('storage/point-transactions/' . basename($transaction->proof)) }}">
                            @endcell
                            <x-slot:empty-state>
                                <p>No recorded transactions at the moment.</p>
                            </x-slot>
                        </x-splade-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>