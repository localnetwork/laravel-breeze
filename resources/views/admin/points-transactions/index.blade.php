<x-app-layout>
    <div class="container">
        <x-splade-table 
            :for="$transactions">
            @cell('proof', $transaction)
                @if($transaction->proof)
                <img width="100" height="100" src="{{ asset('storage/point-transactions/' . basename($transaction->proof)) }}">
                @endif 
            @endcell

            @cell('actions', $transaction)

            @php
                $transaction_user = App\Models\User::find($transaction->user_id);
            @endphp
            
            @if($transaction->status == 'pending')
            <x-dropdown class="z-[10]" placement="bottom-end">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                       Select an action
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>
                
                <x-slot name="content" class="z-[10]">
                    @if($transaction_user->role_id === 2)
                    <Link confirm method="PUT" href="/points/approval/{{$transaction->id}}/topup" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        Approve
                    </Link> 
                    @elseif($transaction_user->role_id === 3)
                    <Link confirm method="PUT" href="/points/approval/{{$transaction->id}}/withdrawal" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        Approve
                    </Link> 
                    @endif
                    <span class="hidden sr-only">Hidden</span>
                </x-slot>
            </x-dropdown>
            @endif
            @endcell
            <x-slot:empty-state>
                <p>No recorded transactions at the moment.</p>
            </x-slot>
        </x-splade-table>
    </div>
</x-app-layout>