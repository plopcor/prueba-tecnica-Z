import { defineStore } from 'pinia';
import api from "../plugins/axios.js";

export const usersStore = defineStore('users', {
    state: () => ({
        init: false,
        users: [],
    }),

    actions: {
        async getAll() {
            this.init = true;
            try {
                const response = await api.get('/users');
                this.users = response.data;
            } catch (error) {
                this.error = error.response?.data?.message || error.message;
                throw this.error
            }
        },

        async add(app) {
            try {
                const response = await api.post('/users', app);
                this.users.push(response.data);
            } catch (error) {
                this.error = error.response?.data?.message || error.message;
                throw this.error;
            }
        },

        async update(id, app) {
            try {
                const response = await api.patch(`/users/${id}`, app);
                const index = this.users.findIndex(app => app.id === id);
                if (index !== -1) {
                    this.users[index] = response.data;
                }
            } catch (error) {
                this.error = error.response?.data?.message || error.message;
                throw this.error;
            }
        },
    },
});
