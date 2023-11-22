<x-app-layout>
    @seoTitle('Profile')
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
                        <h1 class="text-xl mb-[20px] font-medium text-gray-900">Submissions - Contact Form</h1>
                        <x-splade-table :for="$entries" pagination-scroll="head"> 
                        </x-splade-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>
