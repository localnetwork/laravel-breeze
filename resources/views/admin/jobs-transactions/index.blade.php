<x-app-layout>
    @seoTitle('Dashboard')
    @seoDescription('Become the Splade expert!')
    @seoKeywords('laravel, splade, course')
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="max-w-[25%] w-full flex justify-start flex-col">
                    @include('admin.navigation.admin-sidebar')
                </div>
                <div class="max-w-[75%] w-full">
                    <div class="bg-white p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                        <x-splade-table 
                            :for="$transactions">
                            @cell('proofs', $transaction)
                            <div>
                                @foreach($transaction->proofs as $proof)
                                {{-- <img src="/storage/{{  $proof->proof }}"> --}}
                                <div class="proof-item w-full mb-[15px]">
                                    <a href="{{ asset('storage/jobstakenproofs/' . basename($proof->proof)) }}" target="_blank">
                                        <img class="h-auto" width="150" height="150" src="{{ asset('storage/jobstakenproofs/' . basename($proof->proof)) }}">
                                    </a>
                                </div>
                            @endforeach
                            </div>

                            @endcell

                            @cell('amount', $transaction)
                                {{ number_format($transaction->amount, 2) }}
                            @endcell

                            @cell('actions', $transaction)

                            
                            @if($transaction->status === 'reviewing')
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
                                    <Link confirm method="PUT" href="/admin/jobs-transactions/{{$transaction->id}}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                        Approve
                                    </Link> 
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>