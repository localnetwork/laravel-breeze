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
                       Howdy, {{  Auth::user()->name  }}

                       <p class="flex items-center text-sm mt-[15px] text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">Welcome to the dashboard. Use the links in the sidebar to manage the contents.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>