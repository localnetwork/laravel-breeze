<x-app-layout>
    @include('components.user.user-profile-card')
    
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="max-w-[25%] w-full flex justify-start flex-col">
                    @include('components.user.user-sidebar')
                </div>
                <div class="max-w-[75%] w-full">
                    <div class="w-full mx-auto space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl" dusk="update-profile-information">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
            
                        <div class="w-full p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl" dusk="update-password">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
            
                        {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl" dusk="delete-user">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
