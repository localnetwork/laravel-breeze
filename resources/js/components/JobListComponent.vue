<template>
    <div class="max-w-md mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Jobs</h1>
        <input
            v-model="search"
            @input="filterJobs"
            placeholder="Search by Title"
            class="w-full p-2 border rounded-md mb-4"
        />
        <div v-if="jobs.length < 1">NO RESULT</div>
        <ul>
            <li
                v-for="job in jobs"
                :key="job.id"
                class="bg-gray-100 p-2 mb-2 rounded-md"
            >
                {{ job.tree.name }}
                {{ job.user_id.name }}
            </li>
        </ul>
        <div
            class="mt-4 flex justify-between items-center"
            v-if="jobs.length > 0"
        >
            <button
                @click="changePage('prev')"
                :disabled="page === 1"
                class="bg-blue-500 text-white py-2 px-4 rounded-md"
                :class="{ 'cursor-not-allowed': page === 1 }"
            >
                Previous
            </button>
            <ul class="flex space-x-2">
                <li v-for="pageNumber in totalPageNumbers" :key="pageNumber">
                    <button
                        @click="changePage(pageNumber)"
                        :disabled="page === pageNumber"
                        class="bg-blue-500 text-white py-2 px-3 rounded-md"
                        :class="{ 'cursor-not-allowed': page === pageNumber }"
                    >
                        {{ pageNumber }}
                    </button>
                </li>
            </ul>
            <button
                @click="changePage('next')"
                :disabled="page === totalPages"
                class="bg-blue-500 text-white py-2 px-4 rounded-md"
                :class="{ 'cursor-not-allowed': page === totalPages }"
            >
                Next
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted, computed } from "vue";

export default {
    setup() {
        const jobs = ref([]);
        const search = ref("");
        const page = ref(1);
        const totalPages = ref(1);

        const fetchJobs = () => {
            // Make an API request to /api/jobs with pagination
            axios
                .get("/api/jobs", {
                    params: {
                        title: search.value,
                        page: page.value,
                    },
                })
                .then((response) => {
                    jobs.value = response.data.jobs.data;
                    totalPages.value = response.data.jobs.last_page;
                })
                .catch((error) => {
                    console.error("Error fetching jobs", error);
                });
        };

        const filterJobs = () => {
            page.value = 1; // Reset to the first page when searching
            fetchJobs();
        };

        const totalPageNumbers = computed(() => {
            const pageNumbers = [];
            for (let i = 1; i <= totalPages.value; i++) {
                pageNumbers.push(i);
            }
            return pageNumbers;
        });

        const changePage = (pageNumber) => {
            if (pageNumber === "prev" && page.value > 1) {
                page.value--;
            } else if (pageNumber === "next" && page.value < totalPages.value) {
                page.value++;
            } else if (typeof pageNumber === "number") {
                page.value = pageNumber;
            }
            fetchJobs();
        };

        onMounted(() => {
            // Fetch the initial page of jobs
            fetchJobs();
        });

        return {
            jobs,
            search,
            page,
            totalPages,
            filterJobs,
            totalPageNumbers,
            changePage,
        };
    },
};
</script>
