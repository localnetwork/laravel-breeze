<x-app-layout>
    <div class="container">
        <h1 class="text-[var(--textPrimary)] text-[6rem] font-semibold mb-[40px] leading-[6.5rem] text-center">Contact Us</h1>

        <p class="text-center text-[30px] mb-[20px]">To discuss your concerns, submit this contact form</p>

        <x-splade-form method="POST" :action="route('contact.store')" class="mt-6 space-y-6" preserve-scroll>
            
            <div class="flex gap-x-[15px]">
                <x-splade-input type="text" placeholder="Name" name="name" id="name" class="form-control max-w-[50%] w-full" />
                <x-splade-input type="email" placeholder="Email" name="email" id="email" class="form-control max-w-[50%] w-full" />
            </div>

            

            <x-splade-textarea label="Message" name="message" id="message" autosize />

            <div class="flex items-center gap-4">
                <x-splade-submit :label="__('Submit')" />
            </div>
        </x-splade-form>
    </div>
</x-app-layout>