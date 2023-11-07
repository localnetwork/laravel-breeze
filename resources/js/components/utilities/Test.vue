Code snippet
<template>
    <div class="dropdown" @click="toggleDropdown">
        <button class="dropdown-button">{{ buttonText }}</button>
        <div v-if="isOpen" class="dropdown-menu">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";

export default {
    props: {
        buttonText: String,
    },
    setup(props) {
        console.log(props);
        const isOpen = ref(false);

        // Add a new ref to store all open dropdowns
        const allOpenDropdowns = ref([]);

        // Add a new method to close all open dropdowns
        const closeAllDropdowns = () => {
            allOpenDropdowns.value.forEach((dropdown) => {
                dropdown.isOpen = false;
            });
        };

        // Update the toggleDropdown() method to close all other dropdowns when the current dropdown is opened
        const toggleDropdown = () => {
            isOpen.value = !isOpen.value;

            // Close all other dropdowns
            closeAllDropdowns();

            // Add the current dropdown to the list of open dropdowns
            if (isOpen.value) {
                allOpenDropdowns.value.push(this);
            }
        };

        return {
            isOpen,
            toggleDropdown,
        };
    },
};
</script>

<style scoped>
.dropdown {
    display: inline-block;
    position: relative;
}

.dropdown-button {
    cursor: pointer;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.dropdown-menu {
    position: absolute;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 0;
    margin: 0;
    list-style: none;
}

/* Add a CSS rule to show the dropdown menu when it's open */
.dropdown.open .dropdown-menu {
    display: block;
}
</style>
