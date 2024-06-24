<script setup>
import Header from "./components/Header.vue";
import { useUserStore } from "./store/user";
import { useRoute } from "vue-router";
import {ref} from "vue";

const { fetchUser } = useUserStore();
const route = useRoute();

const isReady = ref(false);

if (route.name !== 'auth') {
    fetchUser().then(() => {
        isReady.value = true;
    });
}
</script>

<template>
    <div v-if="isReady" class="overflow-x-hidden bg-gray-100 min-h-screen">
        <Header />

        <div class="container px-6 py-8 mx-auto">
            <router-view />
        </div>
    </div>
</template>

<style scoped>

</style>
