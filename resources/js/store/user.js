import { defineStore } from "pinia";

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null,
    }),

    actions: {
        async fetchUser() {
            const response = await fetch('/api/user');
            const data = await response.json();

            if (response.ok) {
                this.user = data.user;
            } else {
                this.user = null;
            }
        }
    },

    getters: {
        isAuthenticated() {
            return this.user !== null;
        }
    },
});
