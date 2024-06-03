<script setup>
import { computed } from "vue";

const $props = defineProps(['page', 'total', 'limit']);

const totalPages = computed(() => $props.page && $props.limit ? Math.ceil($props.total / $props.limit) : 1);
const pages = computed(() => Array.from({ length: totalPages.value }, (_, i) => i + 1));

const emit = defineEmits(['page']);

const emitPage = (page) => {
    if (page < 1 || page > totalPages.value) {
        return;
    }

    emit('page', page);
}
</script>

<template>
    <nav aria-label="Navigation">
        <ul class="flex items-center -space-x-px h-10 text-base">
            <li>
                <button
                    class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700"
                    @click="emitPage(page - 1)"
                >
                    <span class="sr-only">Previous</span>
                    <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                </button>
            </li>
            <li
                v-for="pageNumber in pages"
                :key="pageNumber"
            >
                <button
                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                    :class="{ 'bg-gray-200 text-gray-700': pageNumber === $props.page }"
                    @click="emitPage(pageNumber)"
                >
                    {{ pageNumber }}
                </button>
            </li>
            <li>
                <button
                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700"
                    @click="emitPage(page + 1)"
                >
                    <span class="sr-only">Next</span>
                    <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </button>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
