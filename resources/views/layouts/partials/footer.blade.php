<footer class="bg-white text-gray-900 py-12">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl font-semibold">CordoPlants</h2>
        </div>
        <ul class="flex space-x-6">
            <li>
                <a href="#" class="hover:text-gray-400">Home</a>
            </li>
            <li>
                <a href="#" class="hover:text-gray-400">About Us</a>
            </li>
            <li>
                <a href="#" class="hover:text-gray-400">Services</a>
            </li>
            <li>
                <a href="#" class="hover:text-gray-400">Contact</a>
            </li>
        </ul>
        <div class="mt-6 md:mt-0">
            <p class="text-sm">Follow Us:</p>
            <div class="flex space-x-4 mt-[15px]">    
                @for($i = 1; $i < 4; $i++)
                <span class="cursor-pointer w-10 h-10 rounded-full block bg-[#333] text-white flex items-center justify-center"> {{ $i }}</span>
                @endfor
            </div>
        </div>
    </div>
</footer>