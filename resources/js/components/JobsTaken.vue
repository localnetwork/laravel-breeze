<template>
vue js
    <div v-for="(transaction, index) in transactions">
    {{ transaction.address.name }}

    {{ transaction.tree.name}}
    {{ transaction }}
        <!-- {{ transaction.id }} -->

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
        }
    },
    created() {
        this.getJobsTaken(); 
    },
    methods: {
        getJobsTaken() {
             const res = axios
                .get("/api/jobs/taken", {})
                .then((response) => {
                    this.transactions = response.data.transactions.data; 
                })
                .catch((error) => {
                    console.error("Error fetching jobs", error);
                });

        }
    },

}
</script>