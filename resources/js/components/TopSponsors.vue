<template>
    <div
        v-if="isLoading == false && volunteers.length > 0"
        v-for="volunteer in volunteers"
    >
        <div
            class="w-full px-6 gap-[15px] py-4 bg-white mb-[30px] dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-wrap"
        >
            <div
                class="relative min-w-[50px] w-[50px] overflow-hidden h-[50px] rounded-full bg-slate-200"
            >
                <img
                    v-if="volunteer.profile_picture"
                    class="absolute h-full w-full object-cover"
                    :src="getProfilePictureUrl(volunteer.profile_picture)"
                />
            </div>
            <div>
                <div class="text-lg font-bold dark:text-white">
                    {{ volunteer.name }}
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-200">
                    @{{ volunteer.short_name }}
                </div>

                <div
                    class="mt-[15px]"
                    v-if="volunteer.bio"
                    v-html="volunteer.bio"
                />
            </div>
        </div>
    </div>

    <div v-if="volunteers.length < 1 && isLoading == false">
        There are no sponsors to show at the moment.
    </div>

    <div v-if="isLoading == true">
        <TopVolunteersSkeleton />
    </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted, computed } from "vue";
import TopVolunteersSkeleton from "./skeletons/TopVolunteersSkeleton.vue";
export default {
    components: {
        TopVolunteersSkeleton,
    },
    watch: {},
    created() {
        this.getTopVolunteers();
    },
    methods: {
        getTopVolunteers() {
            const res = axios
                .get(`/api/top/sponsors`, {})
                .then((response) => {
                    console.log(response);
                    if (response.status === 200) {
                        this.isLoading = false;
                        this.volunteers = response.data.sponsors;
                    }
                })
                .catch((error) => {
                    console.error("Error fetching jobs", error);
                });
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
    },
    data() {
        return {
            isLoading: true,
            volunteers: [],
        };
    },
    props: {},
};
</script>
