import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./pages/articles/index.vue"),
    },
    {
        name: "auth",
        path: "/auth",
        component: () => import("./pages/auth/index.vue"),
    },
    {
        name: "profile",
        path: "/profile",
        component: () => import("./pages/profile/index.vue"),
    },
    {
        name: "categoriesArticles",
        path: "/categories/:slug",
        component: () => import("./pages/categories/articles.vue"),
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
