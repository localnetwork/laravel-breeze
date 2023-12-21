<template>
    <div
        v-for="item in feed"
        class="w-full relative bg-white mb-[30px] dark:bg-gray-800 rounded-xl shadow-md overflow-hidden"
    >
        <div class="flex justify-between items-center px-6 py-4">
            <div class="flex space-x-4 w-full">
                <div
                    class="relative min-w-[50px] w-[50px] overflow-hidden h-[50px] rounded-full bg-slate-200"
                >
                    <img
                        v-if="item.user_id.profile_picture"
                        class="absolute h-full w-full object-cover"
                        :src="
                            getProfilePictureUrl(item.user_id.profile_picture)
                        "
                    />
                </div>
                <div class="w-full">
                    <div class="flex gap-x-[15px] justify-between">
                        <div class="text-lg font-bold dark:text-white">
                            {{ item.user_id.name }} posted a job.
                        </div>
                        <div class="absolute top-[15px] right-[15px]">
                            <Dropdown :id="item.id" dropdown-title="...">
                                <DropdownItem>
                                    <button @click.emit="takeJobModal(item)">
                                        Take Job
                                    </button>
                                </DropdownItem>
                            </Dropdown>
                        </div>
                    </div>

                    <div class="flex gap-x-[7px]">
                        <div class="text-[#00b14f]">x{{ item.stocks }}</div>
                        {{ item.tree.name }} trees
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-200">
                        @{{ item.user_id.short_name }}
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
                        {{ item.address.name }}
                    </div>

                    <div class="border-t-[1px] mt-[5px] pt-[5px]">
                        Estimated earning: {{ item.tree.tree_value }} cordo
                        points.
                    </div>

                    <div class="mt-[10px]" v-if="item.job_takers">
                        <span class="font-bold mb-[5px] block text-[14px]"
                            >Users who took the job:</span
                        >
                        <div class="flex gap-x-[10px]">
                            <div
                                class="relative taker"
                                v-for="volunteer in item.job_takers"
                            >
                                <img
                                    v-if="volunteer.profile_picture"
                                    class="w-[50px] h-[50px] rounded-full object-cover"
                                    :src="
                                        getProfilePictureUrl(
                                            volunteer.profile_picture
                                        )
                                    "
                                />
                                <div
                                    class="w-[50px] h-[50px] rounded-full bg-slate-300"
                                    v-if="!volunteer.profile_picture"
                                ></div>
                                <div
                                    class="absolute volunteer-name whitespace-nowrap bg-[#000] text-white px-[5px] rounded-[5px] left-0 bottom-[100%]"
                                >
                                    {{ volunteer.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="w-full text-[#6e6e6e] relative bg-white p-[50px] min-h-[200px] flex flex-col items-center justify-center mb-[30px] dark:bg-gray-800 rounded-xl shadow-md overflow-hidden"
        v-if="!isLoading && feed.length <= 0"
    >
        <img
            class="max-w-[200px] opacity-[.6] mb-[30px]"
            src="/images/profile/undraw_conference_speaker_re_1rna.svg"
        />
        There no job postings to show in your feed at the moment.
    </div>

    <Skeleton v-if="isLoading" />

    <fwb-toast
        v-if="isShowSuccess"
        class="fixed top-[15px] pr-[40px] right-[15px] shadow-md border-[1px] border-[#ddd]"
        type="success"
    >
        {{ successMsg }}
        <button
            aria-label="Close"
            class="absolute right-[15px] top-[15px] border-none ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            type="button"
            @click="closeToast"
        >
            <span class="sr-only">Close</span
            ><svg
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    clip-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    fill-rule="evenodd"
                ></path>
            </svg>
        </button>
    </fwb-toast>

    <fwb-toast
        v-if="isShowError"
        class="fixed pr-[40px] top-[15px] right-[15px] shadow-md border-[1px] border-[#ddd]"
        type="danger"
    >
        {{ errorMsg }}
        <button
            aria-label="Close"
            class="absolute right-[15px] top-[15px] border-none ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            type="button"
            @click="closeToast"
        >
            <span class="sr-only">Close</span
            ><svg
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    clip-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    fill-rule="evenodd"
                ></path>
            </svg>
        </button>
    </fwb-toast>

    <fwb-modal v-if="isShowModal" @close="closeModal">
        <template #header>
            <div class="flex items-center text-lg">
                Are you sure you want to accept this job?
            </div>
        </template>
        <template #body>
            <p
                class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
            >
                By accepting this job, you won't be able to undo this action.
            </p>
        </template>
        <template #footer>
            <div class="flex justify-between">
                <fwb-button @click="acceptJob()" color="green">
                    I accept
                </fwb-button>
                <fwb-button @click="closeModal" color="alternative">
                    Decline
                </fwb-button>
            </div>
        </template>
    </fwb-modal>
</template>
<script>
import { FwbButton, FwbToast, FwbModal } from "flowbite-vue";
import axios from "axios";
import { ref, onMounted, computed } from "vue";
import Skeleton from "./skeletons/FeedSkeleton.vue";
import Dropdown from "./utilities/Dropdown/Dropdown.vue";
import DropdownItem from "./utilities/Dropdown/DropdownItem.vue";
import DropdownDivider from "./utilities/Dropdown/DropdownDivider.vue";

export default {
    props: {},
    data() {
        return {
            userId: null,
            isLoading: true,
            feed: [],
            isShowError: false,
            isShowSuccess: false,
            isShowModal: false,
            jobTaken: null,
            errorMsg: "",
            successMsg: "",
        };
    },
    watch: {},
    props: {},
    components: {
        Skeleton,
        DropdownItem,
        Dropdown,
        DropdownDivider,
        FwbToast,
        FwbButton,
        FwbModal,
    },
    methods: {
        showSuccess() {},
        getUserInfo() {
            const res = axios
                .get(`/api/user`, {})
                .then((response) => {
                    this.userId = response.data.user.id;
                })
                .catch((error) => {
                    console.error("Error fetching jobs", error);
                });
        },
        closeModal() {
            this.isShowModal = false;
        },
        closeToast() {
            this.isShowError = false;
            this.isShowSuccess = false;
            this.successMsg = "";
            this.errorMsg = "";
        },
        acceptJob() {
            this.isShowModal = false;
            const res = axios
                .post(`/api/job/accept`, {
                    jobId: this.jobTaken,
                    userId: this.userId,
                })
                .then((response) => {
                    console.log("rrrr", response);
                    if (response.status === 200) {
                        this.getFeed();
                        this.isShowSuccess = true;
                        this.successMsg = response.data.message;
                    }
                })
                .catch((error) => {
                    if (error.response.data.message) {
                        this.getFeed();
                        this.errorMsg = error.response.data.message;
                        this.isShowError = true;
                    }
                });
        },
        takeJobModal(item) {
            this.isShowModal = true;
            this.jobTaken = item.id;
        },
        getProfilePictureUrl(profilePicturePath) {
            const baseUrl = window.location.origin;
            if (profilePicturePath) {
                return `${baseUrl}/${profilePicturePath.replace(
                    "public",
                    "storage"
                )}`;
            }
        },
        getFeed() {
            const res = axios
                .get("/api/profile/feed", {})
                .then((response) => {
                    this.feed = response.data.feed.data;
                    console.log(this.feed);

                    console.log(res);
                    if (response.status === 200) {
                        this.isLoading = false;
                    }
                })
                .catch((error) => {
                    console.error("Error fetching jobs", error);
                });
        },
    },
    created() {
        this.getFeed();
        this.getUserInfo();
    },
};
</script>
