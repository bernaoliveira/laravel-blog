<script setup>
import { useRoute } from "vue-router";
import { computed, reactive } from "vue";

const route = useRoute();

const article = reactive({
    title: '',
    content: '',
});

const isInCreationMode = computed(() => route.name === 'articles.create');
const pageTitle = computed(() => isInCreationMode.value ? 'Create Article' : 'Edit Article');

const fetchArticle = async () => {
    try {
        const response = await fetch(`/api/articles/${route.params.slug}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        const data = await response.json();

        article.title = data.title;
        article.content = data.content;
    } catch (error) {
        console.error(error);
    }
}

const saveArticle = async () => {
    try {
        const path = isInCreationMode.value ? '/api/articles' : `/api/articles/${route.params.slug}`;
        const method = isInCreationMode.value ? 'POST' : 'PUT';

        const response = await fetch(path, {
            method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(article),
        });

        if (response.ok) {
            alert('Article saved successfully');
        } else {
            alert('Failed to update article');
        }
    } catch (error) {
        console.error(error);
    }
}

if (!isInCreationMode.value) {
    fetchArticle();
}
</script>

<template>
    <h1 class="text-3xl font-bold leading-none tracking-tight text-gray-900 mb-10">
        {{ pageTitle }}
    </h1>
    <form class="w-100" @submit.prevent="saveArticle">
        <div class="mb-5">
            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
            <input v-model="article.title" type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <div class="mb-5">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
            <textarea v-model="article.content" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Lorem ipsum dollar..."></textarea>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Save</button>
    </form>
</template>
