<script setup>
import {onMounted, ref, toRef} from "vue";

const $emit = defineEmits(['filter']);

const { filters } = defineProps({
    filters: {
        type: Object,
        required: true,
    },
    hideAuthors: {
        type: Boolean,
        default: false,
    },
});
const authors = ref([]);

const search = toRef(filters, 'with_like_title');
const author = toRef(filters, 'with_user_id');
const rating = toRef(filters, 'with_rating');

const handleSubmit = () => {
    $emit('filter', filters);
}

const fetchAuthors = async () => {
    try {
        const response = await fetch('http://localhost/api/authors?limit=5', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        authors.value = (await response.json()).result;
    } catch (error) {
        console.error(error);
    }
}

onMounted(() => {
    fetchAuthors();
});
</script>

<template>
    <form class="px-10 py-6 mx-auto bg-white rounded-lg shadow-md mb-6" @submit.prevent="handleSubmit">
        <div>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input v-model="search" type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Articles...">
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </div>

        <div class="flex mt-4 gap-4">
            <div class="flex-1">
                <label for="rating" class="block mb-2 text-sm font-medium text-gray-900">Rating</label>
                <select v-model="rating" id="rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Choose a rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div v-if="!hideAuthors" class="flex-1">
                <label for="authors" class="block mb-2 text-sm font-medium text-gray-900">Author</label>
                <select v-model="author" id="authors" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Choose an author</option>
                    <option
                        v-for="author in authors"
                        :key="author.id"
                        :value="author.id"
                    >
                        {{ author.name }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
