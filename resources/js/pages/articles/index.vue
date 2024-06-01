<script setup>
import {onMounted, ref} from "vue";

import Header from "../../components/Header.vue";
import ArticleCard from "../../components/ArticleCard.vue";

const search = ref('');
const articles = ref([]);
const page = ref(1);

onMounted(async () => {
    await fetchArticles();
});

const fetchArticles = async (filters) => {
    const params = new URLSearchParams({
        with_relation_user: true,
        with_relation_categories: true,
        limit: 20,
        offset: (page.value - 1) * 20,
        ...filters,
    });

    try {
        const response = await fetch(`http://localhost/api/articles?+${params}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        articles.value = (await response.json()).result;
    } catch (error) {
        console.error(error);
    }
}

const handleSearch = async () => {
    await fetchArticles({ with_title: search.value });
}
</script>

<template>
    <div class="overflow-x-hidden bg-gray-100 min-h-screen">
        <Header />

        <div class="container px-6 py-8 mx-auto max-w-4xl">
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
                v-for="article in articles"
                :key="article.id"
                :article="article"
                class="mb-4"
            />
        </div>
    </div>
</template>

<style scoped>

</style>
