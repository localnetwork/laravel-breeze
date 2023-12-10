<x-app-layout>
    @include('components.user.user-profile-card')
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="w-full max-w-[25%] flex justify-start flex-col">
                    @include('components.user.user-sidebar')
                </div>
                <div class="w-full max-w-[75%]">
                        <JobsTaken />
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>