<template>
    <div
        v-for="(transaction, index) in transactions"
        class="w-full relative bg-white mb-[30px] dark:bg-gray-800 rounded-xl shadow-md overflow-hidden"
    >
        {{ transaction.job.user_id.name }}
        <img
            v-if="transaction.job.user_id.profile_picture"
            class="max-w-[50px] h-full w-full object-cover"
            :src="getProfilePictureUrl(transaction.job.user_id.profile_picture)"
        />
    </div>
</template>

<script>
import { FwbButton, FwbToast, FwbModal } from "flowbite-vue";
import axios from "axios";
import { ref, onMounted, computed } from "vue";

export default {
    data() {
        return {
            transactions: [],
        };
    },
    created() {
        this.getJobsTaken();
    },
    methods: {
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
