<script setup>

import Header from "./components/Header.vue";
</script>

<template>
    <div class="overflow-x-hidden bg-gray-100 min-h-screen">
        <Header />

        <div class="container px-6 py-8 mx-auto">
            <router-view />
        </div>
    </div>
</template>

<style scoped>

</style>
