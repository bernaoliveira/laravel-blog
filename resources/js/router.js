import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./pages/articles/index.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
