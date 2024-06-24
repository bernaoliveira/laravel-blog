<script setup>
import {onMounted, reactive, ref, toRef, watch} from "vue";

import ArticleCard from "../../components/ArticleCard.vue";
import { useArticles } from "../../composables/useArticles";
import Pagination from "../../components/Pagination.vue";
import Filters from "../../components/Filters.vue";
import { useUserStore } from "../../store/user";
import { useRouter } from "vue-router";

const userStore = useUserStore();
const user = toRef(userStore, 'user');
const router = useRouter();

if (!user.value) {
    router.push({ name: 'auth' });
}

const filters = reactive({
    with_like_title: '',
    with_user_id: user.value.id,
    with_rating: '',
});
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

const handlePageChange = async (value) => {
    await changePage(value, filters);

    container.value?.scrollIntoView({ behavior: 'smooth' });
}

onMounted(async () => {
    await fetchArticles(filters);
    await fetchCategories();
});

watch(filters, async () => {
    await changePage(1, filters);
}, { deep: true });
</script>

<template>
    <div ref="container" class="flex">
        <div class="w-full max-w-4xl">
            <Filters
                :filters="filters"
                hide-authors
            />

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
    </div>
</template>

<style scoped>

</style>
