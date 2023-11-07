<template>
    <div class="dropdown inline relative" id="">
        <button
            class="dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            @click="toggleDropdown"
        >
            {{ dropdownTitle }}
        </button>
        <ul class="dropdown-menu absolute top-[100%] w-full bg-white z-[20]">
            <slot />
        </ul>
    </div>
</template>

<script>
import { ref } from "vue";

export default {
    props: {
        dropdownTitle: String,
        dropdownId: Number,
    },
    setup() {
        const dropdownIsOpen = ref(false);

        const toggleDropdown = (e) => {
            const dropdowns = document.querySelectorAll(".dropdown");
            dropdowns.forEach(function (dropdown) {
                if (dropdown.id === e.target.parentElement.id) {
                    if (dropdown.classList.contains("active")) {
                        dropdown.classList.remove("active");
                    } else {
                        dropdown.classList.add("active");
                    }
                } else {
                    dropdown.classList.remove("active");
                }
            });
        };

        // Remove class active in .dropdown if the element clicked is not .dropdown-toggle.
        document.addEventListener("click", function (event) {
            var element = event.target;

            if (!element.classList.contains("dropdown-toggle")) {
                var dd = document.querySelectorAll(".dropdown");
                for (var i = 0; i < dd.length; i++) {
                    var dropdown = dd[i];

                    if (dropdown.classList.contains("active")) {
                        dropdown.classList.remove("active");
                    }
                }
            }
        });

        return {
            dropdownIsOpen,
            toggleDropdown,
        };
    },
};
</script>
