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
        name: "categories.articles",
        path: "/categories/:slug",
        component: () => import("./pages/categories/articles.vue"),
    },
    {
        name: "articles.create",
        path: "/articles/create",
        component: () => import("./pages/articles/detail.vue"),
    },
    {
        name: "articles.edit",
        path: "/articles/edit/:slug",
        component: () => import("./pages/articles/detail.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
