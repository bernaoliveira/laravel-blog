<script setup>
import {onMounted, ref} from "vue";

import ArticleCard from "../../components/ArticleCard.vue";
import { useArticles } from "../../composables/useArticles";
import Pagination from "../../components/Pagination.vue";
import Filters from "../../components/Filters.vue";

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

const handleFilter = async (filters) => {
    await changePage(1, filters);
}

const handlePageChange = async (value) => {
    await changePage(value, { with_like_title: search.value });

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
            <Filters @filter="handleFilter" />

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
