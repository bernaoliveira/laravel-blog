<script setup>

</script>

<template>
    <nav class="px-6 py-4 bg-white shadow">
        <div class="container flex flex-col mx-auto md:flex-row md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <router-link to="/" class="text-xl font-bold text-gray-800 md:text-2xl">Blog</router-link>
                </div>
            </div>
            <div class="flex flex-row -mx-4">
                <router-link to="/" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">Home</router-link>
                <router-link to="/profile" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">My Articles</router-link>
                <router-link to="/profile" class="my-1 text-gray-800 hover:text-blue-500 md:mx-4 md:my-0">Create article</router-link>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
