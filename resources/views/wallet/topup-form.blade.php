<div class="flex mb-[50px] flex-wrap justify-between">
    <h1 class="text-[40px] leading-[32px] font-medium text-gray-900">Add Cordo points</h1>
    <Link href="/wallet/transactions">View Transactions</Link>
</div>
<div class="w-full text-[20px] mb-[40px]">
    Current Cordo Points: {{ number_format($userPoints) }}
</div>
<x-splade-form  id="topupForm" 
    confirm
    method="POST" :action="route('wallet.store')" class="mt-6 space-y-6" preserve-scroll>
    
    <div id="step-1" class="step bg-[#f3f3f3] p-[30px] pt-[5px] rounded-[15px] relative">
        <span class="border-[5px] border-color-[#f3f3f3] flex items-center justify-center absolute w-[50px] h-[50px] text-[18px] text-white top-[-15px] bg-[#00b14f] rounded-full text-center font-bold">1</span>
        <h2 class="text-[#280031] text-[20px] font-bold pl-[60px] mb-[10px]">Enter an amount </h2>
        <x-splade-input type="number" name="amount" id="amount" placeholder="Enter amount" class="form-control" />
        
    </div>

    <div id="step-2" class="step bg-[#f3f3f3] p-[30px] pt-[5px] rounded-[15px] relative">
        <span class="border-[5px] border-color-[#f3f3f3] flex items-center justify-center absolute w-[50px] h-[50px] text-[18px] text-white top-[-15px] bg-[#00b14f] rounded-full text-center font-bold">2</span>
        <h2 class="text-[#280031] text-[20px] font-bold pl-[60px] mb-[10px]">Select a Payment </h2>
        <x-splade-group name="payment_method" class="payment-methods">
            {{-- <x-splade-radio name="notification_channel" value="mail" label="Mail" />
            <x-splade-radio name="notification_channel" value="slack" label="Slack" /> --}}
        <div>
            @foreach($payment_methods as $payment_method)
                <x-splade-radio class="block w-full payment-item" name="payment_method" id="{{ $payment_method->id }}" value="{{ $payment_method->id }}">
                    <label class="rounded-xl shadow-md cursor-pointer  bg-white block mb-[15px]" for="{{ $payment_method->id }}"> 
                        <div class="px-[30px] py-[30px] text-[25px] font-bold">
                            {{ $payment_method->title }} 
                        </div>
                        <div class="footer-info px-[30px] pt-[15px] pb-[15px]">
                            <span class="font-bold text-[#0b9749] text-[16px] mb-[5px] block">Instruction: </span>
                            <div>{{ $payment_method->instruction }}</div>
                        </div>
                    </label>
                </x-splade-radio>
            @endforeach
        </div>
        </x-splade-group>
    </div>

    <div id="step-1" class="step bg-[#f3f3f3] p-[30px] pt-[5px] rounded-[15px] relative">
        <span class="border-[5px] border-color-[#f3f3f3] flex items-center justify-center absolute w-[50px] h-[50px] text-[18px] text-white top-[-15px] bg-[#00b14f] rounded-full text-center font-bold">3</span>
        <h2 class="text-[#280031] text-[20px] font-bold pl-[60px] mb-[10px]">Attach a screenshot of your purchase </h2>
        <x-splade-file accept="image/png, image/jpg, image/jpeg, image/webp" max-size="3MB" filepond="{ allowDrop: true }" dusk="proof" name="proof" @input="form.proof = $event.target.files[0]" /> 
        <img class='max-w-[150px] max-h-[150px]' v-if="form.proof" :src="form.$fileAsUrl('proof')" />
    </div>

    <div class="flex items-center gap-4"> 
        {{-- <x-splade-submit :spinner="true" class="max-w-[280px] w-full min-w-[100px] box-shadow-[-5px 5px 10px rgb(0 0 0 / 16%)]" :label="__('Buy Now')" /> --}}
        <input class="text-[20px] hover:bg-[#0b9749] bg-[#00b14f] py-[15px] px-[30px] rounded-full cursor-pointer text-uppercase text-white max-w-[280px] w-full min-w-[100px] " type="submit" value="Buy Now" />
    </div>
</x-splade-form>