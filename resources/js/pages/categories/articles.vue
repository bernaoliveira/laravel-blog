<script setup>
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import ArticleCard from "../../components/ArticleCard.vue";

const articles = ref([]);
const route = useRoute();

const fetchCategoryArticles = async () => {
    try {
        const params = new URLSearchParams({
            with_relation_categories: true,
            with_relation_user: true,
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

onMounted(async () => {
    await fetchCategoryArticles();
});
</script>

<template>
    <ArticleCard
        v-for="article in articles"
        :key="article.id"
        :article="article"
        class="mb-4"
    />
</template>

<style scoped>

</style>
