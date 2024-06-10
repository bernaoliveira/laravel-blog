<script setup>
import {onMounted, reactive, ref, watch} from "vue";
import { useRoute } from "vue-router";
import ArticleCard from "../../components/ArticleCard.vue";
import Filters from "../../components/Filters.vue";
import Pagination from "../../components/Pagination.vue";

const articles = ref([]);
const route = useRoute();

const page = ref(route.query.page ? parseInt(route.query.page) : 1);
const total = ref(0);

const filters = reactive({
    with_like_title: '',
    with_user_id: '',
    with_rating: '',
});

const fetchCategoryArticles = async (filters) => {
    try {
        const params = new URLSearchParams({
            with_relation_categories: true,
            with_relation_user: true,
            limit: 20,
            offset: (page.value - 1) * 20,
            ...filters,
        });

        const response = await fetch(`http://localhost/api/categories/${route.params.slug}/articles?${params}`, {
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

const handlePageChange = async (value) => {
    page.value = value;
    await fetchCategoryArticles(filters);
}

onMounted(async () => {
    await fetchCategoryArticles();
});

watch(filters, async () => {
    await handlePageChange(1);
}, { deep: true });
</script>

<template>
    <div class="w-full max-w-4xl mx-auto">
        <Filters :filters="filters" />

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
</template>

<style scoped>

</style>
