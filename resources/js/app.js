import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";
import "@protonemedia/laravel-splade/dist/jodit.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";

import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";

import JobListComponent from "./components/JobListComponent.vue";
import VolunteerFeed from "./components/VolunteerFeed.vue";
import TestVue from "./components/Test.vue";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");

console.log("test");

createApp({
    render: renderSpladeApp({ el }),
})
    .use(SpladePlugin, {
        max_keep_alive: 10,
        transform_anchors: false,
        progress_bar: true,
        components: {
            JobListComponent,
            VolunteerFeed,
        },
    })
    .use(Toast)
    .mount(el);
