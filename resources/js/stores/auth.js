import { defineStore } from 'pinia';
import api from "../plugins/axios.js";

export const authStore = defineStore('auth', {
    state: () => ({
        init: false,
        user: null,
        error: null,
    }),

    getters: {
        isAuthenticated: (state) => !!state.user ? true : false,
        isAdmin: (state) => !!state.user?.is_admin,
    },

    actions: {
        async getUser() {
            this.error = null;
            this.init = true;
            try {
                const { data } = await api.get('/auth/user');
                this.user = data;
            } catch (err) {
                this.user = null;
                this.error = err.response?.data?.message || 'Failed retrieving user';
            }
        },

        async login(username, password) {
            this.error = null;
            try {
                // Nota: Laravel lo añade al cargar Blade //await axios.get('/sanctum/csrf-cookie');
                await api.post('/auth/login', { username, password });
                await this.getUser();
                return true;
            } catch (err) {
                this.error = err.response?.data?.message || 'Login failed';
                return false;
            }
        },

        async logout() {
            try {
                await api.post('/auth/logout');
                this.user = null;
                this.init = false;
            } catch (err) {
                console.error(err);
            }
        },
    },
});
