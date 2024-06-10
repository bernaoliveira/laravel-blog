<script setup>
/**
 * Article {
 *     id: number;
 *     user_id: number;
 *     slug: string;
 *     title: string;
 *     content: string;
 *     rating: null | number;
 *     votes: number;
 *     created_at: string;
 *     updated_at: string;
 *     user: {
 *         id: number;
 *         name: string;
 *         email: string;
 *         email_verified_at: string;
 *         created_at: string;
 *         updated_at: string;
 *     },
 *     categories: [
 *         {
 *             id: number;
 *             slug: string;
 *             name: string;
 *         }
 *     ]
 * }
 */
const { article } = defineProps(['article']);
</script>

<template>
    <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <span class="font-light text-gray-600">{{ new Date(article.created_at).toDateString() }}</span>
            <div class="flex gap-2">
                <router-link
                    v-for="category in article.categories"
                    :key="category.id"
                    to="/"
                    class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500"
                >
                    {{ category.name.toUpperCase() }}
                </router-link>
            </div>
        </div>
        <div class="mt-2">
            <router-link
                to="/"
                class="text-2xl font-bold text-gray-700 hover:underline"
            >
                ({{ article.rating }})
                {{ article.title }}
            </router-link>

            <p class="mt-2 text-gray-600">
                {{ article.content }}
            </p>
        </div>
        <div class="flex items-center justify-between mt-4">
            <router-link
                to="/"
                class="text-blue-500 hover:underline"
            >
                Read more
            </router-link>

            <span class="font-bold text-gray-700 hover:underline">
                {{ article.user.name }}
            </span>
        </div>
    </div>
</template>

<style scoped>

</style>
