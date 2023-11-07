<x-app-layout>

    <x-splade-form method="POST" :action="route('wallet.store')" class="mt-6 space-y-6" preserve-scroll>
            
        <x-splade-input type="number" label="Amount" name="amount" id="amount" class="form-control" />
        <x-splade-file label="Proof" filepond="{ allowDrop: true }" dusk="proof" name="proof" @input="form.proof = $event.target.files[0]" /> 
        <img class='max-w-[150px]' v-if="form.proof" :src="form.$fileAsUrl('proof')" />
        <p v-text="form.errors.proof" />

        <div class="flex items-center gap-4"> 
            <x-splade-submit :label="__('Add')" />
        </div>
    </x-splade-form>
</x-app-layout>