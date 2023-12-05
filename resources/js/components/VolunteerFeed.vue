<template>
    <div
        v-for="item in feed"
        class="w-full relative bg-white mb-[30px] dark:bg-gray-800 rounded-xl shadow-md overflow-hidden"
    >
        <!-- {{ item.user_id.profile_picture }} -->
        <div class="flex justify-between items-center px-6 py-4">
            <div class="flex space-x-4 w-full">
                <div
                    class="relative min-w-[50px] w-[50px] overflow-hidden h-[50px] rounded-full bg-slate-200"
                >
                    <img
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
                </div>
            </div>
        </div>
    </div>

    <Skeleton v-if="isLoading" />
</template>
<script>
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
            isLoading: true,
            feed: [],
        };
    },
    watch: {},
    props: {},
    components: {
        Skeleton,
        DropdownItem,
        Dropdown,
        DropdownDivider,
    },
    methods: {
        takeJobModal(item) {
            console.log(item);
        },
        getProfilePictureUrl(profilePicturePath) {
            const baseUrl = window.location.origin;
            return `${baseUrl}/${profilePicturePath.replace(
                "public",
                "storage"
            )}`;
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
    },
};
</script>