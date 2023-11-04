<x-app-layout>
    @seoTitle('Profile')
    @seoDescription('Become the Splade expert!')
    @seoKeywords('laravel, splade, course')

    @include('components.user.user-profile-card')
    <div class="py-12 bg-[#f3f3f3]">
        <div class="container">
            <div class="row">
                <div class="max-w-[25%] w-full flex justify-start flex-co">
                    @include('components.user.user-sidebar')
                </div>
                <div class="max-w-[75%]">

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 