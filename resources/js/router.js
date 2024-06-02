import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./pages/articles/index.vue"),
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
