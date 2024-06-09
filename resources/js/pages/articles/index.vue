<script setup>
import {onMounted, ref} from "vue";

import ArticleCard from "../../components/ArticleCard.vue";
import { useArticles } from "../../composables/useArticles";
import Pagination from "../../components/Pagination.vue";

const search = ref('');
const categories = ref([]);

const { articles, fetchArticles, changePage, page, total } = useArticles();

const container = ref(null);

const fetchCategories = async () => {
    try {
        const response = await fetch('http://localhost/api/categories', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        categories.value = (await response.json()).result;
    } catch (error) {
        console.error(error);
    }
}

const handleSearch = async () => {
    await changePage(1);
    await fetchArticles({ with_like_title: search.value });
}

const handlePageChange = async (value) => {
    await changePage(value);
    await fetchArticles({ with_like_title: search.value });

    container.value?.scrollIntoView({ behavior: 'smooth' });
}

onMounted(async () => {
    await fetchArticles({ with_like_title: search.value });
    await fetchCategories();
});
</script>

<template>
    <div ref="container" class="flex">
        <div class="w-full max-w-4xl">
            <form class="mb-6" @submit.prevent="handleSearch">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input v-model="search" type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Articles...">
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </form>

            <ArticleCard
                v-if="articles.length > 0"
                v-for="article in articles"
                :key="article.id"
                :article="article"
                class="mb-4"
            />

            <div v-else class="flex items-center justify-center h-96">
                <p class="text-lg font-semibold text-gray-700">No articles found</p>
            </div>

            <Pagination
                :page="page"
                :total="total"
                :limit="20"
                @page="handlePageChange"
            />
        </div>

        <div class="ml-6">
            <div class="bg-white p-6 rounded-lg shadow-md w-96">
                <h2 class="text-lg font-semibold text-gray-700">Categories</h2>
                <ul class="mt-4">
                    <li
                        v-for="category in categories"
                        :key="category.id"
                        class="flex items-center justify-between py-2"
                    >
                        <router-link
                            :to="{ name: 'categoriesArticles', params: {slug: category.slug}}"
                            class="text-gray-700 hover:underline"
                        >
                            {{ category.name }}
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
