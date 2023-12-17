<template>
    <div
        v-for="item in transactions"
        class="w-full relative bg-white mb-[30px] dark:bg-gray-800 rounded-xl shadow-md overflow-hidden"
    >
        <div class="flex justify-between items-center px-6 py-4">
            <div class="flex space-x-4 w-full">
                <div
                    class="relative min-w-[50px] w-[50px] overflow-hidden h-[50px] rounded-full bg-slate-200"
                >
                    <img
                        v-if="item.job.user_id.profile_picture"
                        class="absolute h-full w-full object-cover"
                        :src="
                            getProfilePictureUrl(
                                item.job.user_id.profile_picture
                            )
                        "
                    />
                </div>
                <div class="w-full">
                    <div class="flex gap-x-[15px] justify-between">
                        <div class="text-lg font-bold dark:text-white">
                            Posted by {{ item.job.user_id.name }}
                        </div>
                        <div
                            class="absolute top-[15px] right-[15px]"
                            v-if="item.status === 'accepted'"
                        >
                            <Dropdown :id="item.id" dropdown-title="...">
                                <DropdownItem>
                                    <button @click.emit="completeJob(item)">
                                        Complete job
                                    </button>
                                </DropdownItem>
                            </Dropdown>
                        </div>
                    </div>

                    <div class="flex gap-x-[7px]">
                        {{ item.job.tree.name }}
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-200">
                        @{{ item.job.user_id.short_name }}
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
                        {{ item.job.address.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <fwb-modal v-if="showModal" @close="closeModal">
        <template #header>
            <div class="flex items-center text-lg">Upload proof</div>
        </template>
        <template #body>
            <p
                class="text-base leading-relaxed text-gray-500 dark:text-gray-400 mb-[15px]"
            >
                Please upload your proof that you've completed this job.
            </p>

            <div>
                <div class="form-item flex flex-col">
                    <label class="mb-[5px]" for="files"> Upload files </label>
                    <input
                        class="border-dashed border-[#ddd] border-[1px] p-[15px]"
                        name="files"
                        id="files"
                        type="file"
                        multiple
                        ref="fileInput"
                        required
                        @change="updateFiles"
                    />
                    <p
                        class="text-[14px] mt-[5px] text-red-600"
                        v-if="errorMsg"
                    >
                        Please upload a proof.
                    </p>
                </div>
                <div class="form-actions mt-[30px]">
                    <input
                        class="border cursor-pointer rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-[#00b14f] min-w-[100px] text-white"
                        type="submit"
                        @click="submitFiles"
                        value="Submit"
                    />
                </div>
            </div>
        </template>
    </fwb-modal>

    <fwb-toast
        v-if="successMsg"
        class="fixed top-[15px] pr-[40px] right-[15px] shadow-md border-[1px] border-[#ddd]"
        type="success"
    >
        Successfully sent a request for review.
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
    data() {
        return {
            showModal: false,
            transactions: [],
            currentTransaction: "",
            currentJob: "",
            files: [],
            errorMsg: "",
            successMsg: "",
        };
    },
    components: {
        Skeleton,
        DropdownItem,
        Dropdown,
        DropdownDivider,
        FwbToast,
        FwbButton,
        FwbModal,
    },
    created() {
        this.getJobsTaken();
    },
    methods: {
        closeToast() {
            this.clearAll();
            this.successMsg = "";
        },
        clearAll() {
            this.showModal = false;
            this.currentTransaction = "";
            this.files = [];
            this.errorMsg = "";
            this.currentJob = "";
        },
        submitFiles() {
            const formData = new FormData();
            for (let i = 0; i < this.files.length; i++) {
                formData.append(`files[${i}]`, this.files[i]);
            }
            formData.append("transactionId", this.currentTransaction);
            const res = axios
                .post(`/api/upload/proof`, formData, {})
                .then((response) => {
                    console.log("rrrr", response);
                    console.log("transaction", this.currentTransaction);
                    if (response.status === 200) {
                        console.log(
                            "Files uploaded successfully:",
                            response.data.paths
                        );
                        this.clearAll();
                        this.successMsg = "Successfully updated.";
                        this.getJobsTaken();
                    }
                })
                .catch((error) => {
                    console.error("Error uploading files:", error);
                    this.errorMsg = "Please upload a proof.";
                });
        },
        updateFiles() {
            this.files = this.$refs.fileInput.files;
            console.log(this.files);
        },
        closeModal() {
            this.showModal = false;
        },
        completeJob(item) {
            console.log("clicked!");
            this.showModal = true;
            this.currentJob = item.job_id;
            this.currentTransaction = item.id;
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
        getJobsTaken() {
            const res = axios
                .get("/api/jobs/taken", {})
                .then((response) => {
                    this.transactions = response.data.transactions.data;
                })
                .catch((error) => {
                    console.error("Error fetching jobs", error);
                });
        },
    },
};
</script>
