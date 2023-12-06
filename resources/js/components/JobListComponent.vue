<template>
    <v-modal v-model="showm" v-if="showm">
        <div class="fixed z-10 inset-0 overflow-hidden">
            <div
                class="fixed z-30 inset-0 bg-black/75 z-[1]"
                @click="hideModal"
            ></div>
            <div
                class="flex w-full max-w-lg m-4 justify-center items-center relative z-[2] min-h-screen mx-auto transition-opacity duration-300 ease-in-out"
            >
                <div class="w-full rounded-lg shadow-lg bg-white p-6 relative">
                    <button
                        @click="hideModal"
                        dusk="close-modal-button"
                        type="button"
                        class="absolute top-[15px] right-[15px] text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Close</span
                        ><svg
                            class="h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                    <div class="mb-4">
                        <h2 class="text-lg font-medium text-gray-900 mb-[15px]">
                            #{{ job.id }} Edit this job
                        </h2>

                        <!-- <ul v-if="errors" class="error-list">
                                <li v-for="error in errors" class="error-item">
                                    {{ error }}
                                </li>
                            </ul> -->
                        <form @submit.prevent="handleSubmit(job)">
                            <div class="form-item mb-[15px]">
                                <!-- <label
                                    class="w-full mb-[5px] block"
                                    for="job_description"
                                    >Job Description:</label
                                >
                                <textarea
                                    type="text"
                                    id="job_description"
                                    name="job_description"
                                    v-model="jobDescription"
                                    :class="
                                        'flex rounded-md border border-gray-300 shadow-sm border-gray-300 block w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded-md' +
                                        {
                                            validated:
                                                errorKeys &&
                                                errorKeys.includes(
                                                    'job_description'
                                                ),
                                        }
                                    "
                                /> -->
                                <!-- <p
                                    class="text-red-600 text-sm mt-2 font-sans"
                                    v-if="
                                        errorKeys &&
                                        errorKeys.includes('job_description')
                                    "
                                >
                                    {{
                                        errors[
                                            errorKeys.indexOf("job_description")
                                        ]
                                    }}
                                </p> -->
                            </div>
                            <div class="form-item mb-[15px]">
                                <label
                                    class="w-full mb-[5px] block"
                                    for="quantity"
                                    >Quantity:</label
                                >
                                <input
                                    class="flex rounded-md border border-gray-300 shadow-sm border-gray-300 block w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded-md"
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    v-model="quantity"
                                    :class="{
                                        'w-full border-indigo-600 border-1':
                                            errorKeys &&
                                            errorKeys.includes('quantity'),
                                    }"
                                />

                                <p
                                    class="text-red-600 text-sm mt-2 font-sans"
                                    v-if="
                                        errorKeys &&
                                        errorKeys.includes('quantity')
                                    "
                                >
                                    {{ errors[errorKeys.indexOf("quantity")] }}
                                </p>
                            </div>
                            <div class="form-item">
                                <label class="w-full mb-[5px] block" for="tree"
                                    >Select a tree</label
                                >
                                <select
                                    class="flex rounded-md border border-gray-300 shadow-sm border-gray-300 block w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded-md"
                                    id="tree"
                                    name="tree"
                                    v-model="tree"
                                >
                                    <option
                                        v-for="(item, index) in trees"
                                        v-bind:value="item.id"
                                        :selected="item.id === job.tree.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="flex gap-x-[15px] mt-[30px]">
                                <button
                                    @click="testClick"
                                    type="submit"
                                    class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[#00b14f] text-white border-transparent hover:bg-[#0b9749] focus:border-indigo-300 focus:ring-indigo-200"
                                >
                                    Update
                                </button>
                                <button
                                    class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[#00b14f] border-transparent hover:bg-[#0b9749] focus:border-indigo-300 focus:ring-indigo-200 bg-gray-300 text-gray-600 hover:text-gray-100 font-bold py-2 px-4 rounded-lg hover:bg-gray-500"
                                    @click="hideModal"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </v-modal>

    <div class="alert alert-success" v-if="successMessage">
        You've successfully updated the job.
        <button
            @click="closeToast"
            dusk="close-modal-button"
            type="button"
            class="absolute top-[15px] right-[5px] text-gray-400 hover:text-gray-500"
        >
            <span class="sr-only">Close</span
            ><svg
                class="h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                ></path>
            </svg>
        </button>
    </div>

    <input
        v-model="search"
        @input="filterJobs"
        placeholder="Search by address, tree"
        class="mb-4 flex rounded-md border border-gray-300 shadow-sm border-gray-300 block w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed rounded-md[object Object]"
    />
    <div v-if="jobs.length < 1">NO RESULT</div>
    <x-splade-rehydrate>
        <div
            v-for="job in jobs"
            :key="job.id"
            class="relative w-full p-[15px] bg-white mb-[30px] dark:bg-gray-800 rounded-xl shadow-md"
        >
            <!-- {{ job.id }}
            {{ job.tree.name }} -->
            <div class="flex">
                <div>
                    <img
                        src="https://cordo-plants.vercel.app/_next/image?url=%2Fimages%2Fcontributors%2Fsponsors%2Fjollibee.png&w=48&q=75"
                    />
                </div>
                <div>
                    <div class="text-lg font-bold dark:text-white">
                        <!-- {{ job.user_id.name }} -->
                        You've posted a job
                        <!-- {{ userData }} -->
                    </div>

                    <div class="flex gap-[5px]">
                        <span class="text-[#00b14f]">x{{ job.quantity }}</span>
                        {{ job.tree.name }} trees
                    </div>
                    <div
                        class="text-sm text-gray-500 dark:text-gray-200"
                        v-if="job.user_id.short_name"
                    >
                        <!-- @shortname -->
                        @{{ job.user_id.short_name }}
                    </div>
                    <div
                        class="location flex gap-x-[5px] items-center py-[15px]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="30"
                            height="30"
                            x="0"
                            y="0"
                            viewBox="0 0 512 512"
                            style="enable-background: new 0 0 512 512"
                            xml:space="preserve"
                            class=""
                        >
                            <g>
                                <path
                                    d="M341.476 338.285c54.483-85.493 47.634-74.827 49.204-77.056C410.516 233.251 421 200.322 421 166 421 74.98 347.139 0 256 0 165.158 0 91 74.832 91 166c0 34.3 10.704 68.091 31.19 96.446l48.332 75.84C118.847 346.227 31 369.892 31 422c0 18.995 12.398 46.065 71.462 67.159C143.704 503.888 198.231 512 256 512c108.025 0 225-30.472 225-90 0-52.117-87.744-75.757-139.524-83.715zm-194.227-92.34a15.57 15.57 0 0 0-.517-.758C129.685 221.735 121 193.941 121 166c0-75.018 60.406-136 135-136 74.439 0 135 61.009 135 136 0 27.986-8.521 54.837-24.646 77.671-1.445 1.906 6.094-9.806-110.354 172.918L147.249 245.945zM256 482c-117.994 0-195-34.683-195-60 0-17.016 39.568-44.995 127.248-55.901l55.102 86.463a14.998 14.998 0 0 0 25.298 0l55.101-86.463C411.431 377.005 451 404.984 451 422c0 25.102-76.313 60-195 60z"
                                    fill="#000000"
                                    opacity="1"
                                    data-original="#000000"
                                    class=""
                                ></path>
                                <path
                                    d="M256 91c-41.355 0-75 33.645-75 75s33.645 75 75 75 75-33.645 75-75-33.645-75-75-75zm0 120c-24.813 0-45-20.187-45-45s20.187-45 45-45 45 20.187 45 45-20.187 45-45 45z"
                                    fill="#000000"
                                    opacity="1"
                                    data-original="#000000"
                                    class=""
                                ></path>
                            </g>
                        </svg>
                        {{ job.address.name }}
                    </div>
                </div>
            </div>
            <div class="border-t-[2px] w-full pt-[15px] mt-[10px]">
                <div
                    class="text-sm text-gray-800 dark:text-gray-200"
                    v-html="job.job_description"
                />
                <div class="sharethis-inline-share-buttons"></div>
            </div>

            <!-- <div class="absolute top-[15px] right-[15px]">
                <Dropdown :id="job.id" dropdown-title="...">
                    <DropdownItem>
                        <button @click.emit="showModal(job)">Edit</button>
                    </DropdownItem>
                </Dropdown>
            </div> -->
        </div>
    </x-splade-rehydrate>
    <div class="mt-4 flex justify-between items-center" v-if="jobs.length > 0">
        <button
            @click="changePage('prev')"
            :disabled="page === 1"
            class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[#00b14f] text-white border-transparent hover:bg-[#0b9749] focus:border-indigo-300 focus:ring-indigo-200"
            :class="{ 'cursor-not-allowed': page === 1 }"
        >
            Previous
        </button>
        <ul class="flex space-x-2">
            <li v-for="pageNumber in totalPageNumbers" :key="pageNumber">
                <button
                    @click="changePage(pageNumber)"
                    :disabled="page === pageNumber"
                    class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[#00b14f] text-white border-transparent hover:bg-[#0b9749] focus:border-indigo-300 focus:ring-indigo-200"
                    :class="{
                        'opacity-[.5] cursor-not-allowed': page === pageNumber,
                    }"
                >
                    {{ pageNumber }}
                </button>
            </li>
        </ul>
        <button
            @click="changePage('next')"
            :disabled="page === totalPages"
            class="inline-block mb-3 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[#00b14f] text-white border-transparent hover:bg-[#0b9749] focus:border-indigo-300 focus:ring-indigo-200"
            :class="{ 'cursor-not-allowed': page === totalPages }"
        >
            Next
        </button>
    </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted, computed } from "vue";
import Dropdown from "./utilities/Dropdown/Dropdown.vue";
import DropdownItem from "./utilities/Dropdown/DropdownItem.vue";
import DropdownDivider from "./utilities/Dropdown/DropdownDivider.vue";

export default {
    methods: {
        closeToast() {
            this.successMessage = false;
        },
        open() {
            this.isOpen = true;
            console.log(user);
        },
        showModal(job) {
            this.job = job;
            this.showm = true;
            this.jobDescription = job.job_description;
            this.tree = job.tree.id;
            this.quantity = job.quantity;
            this.errors = null;
            this.errorKeys = null;
            this.successMessage = null;
        },
        hideModal() {
            this.showm = false;
        },
        handleSubmit(job) {
            axios
                .patch(`/api/jobs/${job.id}`, {
                    job_description: this.jobDescription,
                    quantity: this.quantity,
                    tree: this.tree,
                })
                .then((response) => {
                    this.showm = false;
                    this.errors = null;
                    this.errorKeys = null;
                    this.successMessage = true;
                    // this.fetchJobs();
                    setTimeout(function () {
                        this.successMessage = false;
                        const el = document.querySelector(".alert");

                        el.classList.add("hidden");
                    }, 3000);
                })
                .catch((error) => {
                    if (error.response) {
                        this.errors = [];
                        this.errorKeys = [];
                        const errors = error.response.data.errors;
                        if (errors) {
                            for (const property in errors) {
                                if (errors.hasOwnProperty(property)) {
                                    this.errorKeys.push(`${property}`);
                                    this.errors.push(
                                        `${errors[property].join(", ")}`
                                    );
                                }
                            }
                        }
                    } else {
                        console.error("An unknown error occurred.");
                    }
                });
        },
    },
    data() {
        return {
            isOpen: false,
            showm: false,
            jobDescription: null,
            tree: null,
            quantity: null,
            userData: null,
            trees: null,
            successMessage: false,
            errors: [],
            errorKeys: [],
        };
    },
    components: {
        Dropdown,
        DropdownItem,
        DropdownDivider,
    },
    setup() {
        console.log("setuppp");
        const jobs = ref([]);
        const search = ref("");
        const page = ref(1);
        const totalPages = ref(1);
        const userData = ref([]);
        const trees = ref([]);
        const activeDropdown = ref(null);

        const closeOtherDropdowns = () => {
            document.querySelectorAll(".dropdown").forEach((dropdown) => {
                if (dropdown !== event.target) {
                    dropdown
                        .querySelector(".dropdown-menu")
                        .classList.remove("active");
                }
            });
        };

        const openActiveDropdown = () => {
            if (activeDropdown.value) {
                activeDropdown.value
                    .querySelector(".dropdown-menu")
                    .classList.add("active");
            }
        };

        const fetchJobs = () => {
            console.log("fetchJobs");
            axios
                .get("/api/jobs", {
                    params: {
                        // title: search.value,
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

        const fetchTrees = () => {
            console.log("fetchTrees");
            axios
                .get("/api/trees")
                .then((response) => {
                    trees.value = response.data.trees;
                })
                .catch((error) => {
                    // Handle errors
                    console.error("Error fetching data:", error);
                });
        };

        const getUserInfo = () => {
            axios
                .get("/api/user")
                .then((response) => {
                    userData.value = response.data.user;
                })
                .catch((error) => {
                    // Handle errors
                    console.error("Error fetching data:", error);
                });
            console.log(userData);
        };

        const filterJobs = () => {
            page.value = 1;
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
        const testClick = () => {
            fetchJobs();
            filterJobs();
        };
        onMounted(() => {
            getUserInfo();
            fetchTrees();
            fetchJobs();
        });

        return {
            jobs,
            fetchTrees,
            userData,
            trees,
            search,
            page,
            totalPages,
            getUserInfo,
            testClick,
            filterJobs,
            totalPageNumbers,
            changePage,
            activeDropdown,
            closeOtherDropdowns,
            openActiveDropdown,
        };
    },
};
</script>
