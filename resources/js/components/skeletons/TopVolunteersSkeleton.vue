<template>
    <div v-for="i in 4">
        <div
            class="w-full bg-white mb-[30px] dark:bg-gray-800 rounded-xl shadow-md overflow-hidden"
        >
            <div class="flex justify-between items-center px-6 py-4">
                <div class="flex space-x-4 w-full">
                    <div
                        class="min-w-[50px] w-[50px] h-[50px] rounded-full skeleton-pulse bg-slate-200"
                    ></div>
                    <div class="w-full">
                        <div class="flex gap-x-[15px] justify-between">
                            <div
                                class="w-full h-[20px] max-w-[250px] rounded mb-[10px] skeleton-pulse bg-slate-200"
                            ></div>
                            <div
                                class="w-full h-[20px] max-w-[30px] rounded mb-[10px] skeleton-pulse bg-slate-200"
                            ></div>
                        </div>

                        <div class="flex gap-x-[15px]">
                            <div
                                class="w-full h-[20px] max-w-[50px] rounded mb-[10px] bg-[#88e3b1] skeleton-pulse"
                            ></div>
                            <div
                                class="w-full h-[20px] max-w-[100px] rounded mb-[10px] skeleton-pulse bg-slate-200"
                            ></div>
                        </div>
                        <div
                            class="w-full h-[10px] max-w-[150px] rounded mb-[10px] skeleton-pulse bg-slate-200"
                        ></div>
                        <div
                            class="w-full h-[30px] max-w-[250px] rounded mb-[10px] skeleton-pulse bg-slate-200"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
