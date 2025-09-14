import { defineStore } from 'pinia';
import api from "../plugins/axios.js";

export const applicationsStore = defineStore('applications', {
    state: () => ({
        init: false,
        applications: [],
    }),

    actions: {
        async getAll() {
            this.init = true;
            try {
                const response = await api.get('/apps');
                this.applications = response.data;
            } catch (error) {
                this.error = error.response?.data?.message || error.message;
                throw this.error
            }
        },

        async add(app) {
            try {
                const response = await api.post('/apps', app);
                this.applications.push(response.data);
            } catch (error) {
                this.error = error.response?.data?.message || error.message;
                throw this.error;
            }
        },

        async update(id, app) {
            try {
                const response = await api.patch(`/apps/${id}`, app);
                const index = this.applications.findIndex(app => app.id === id);
                if (index !== -1) {
                    this.applications[index] = response.data;
                }
            } catch (error) {
                this.error = error.response?.data?.message || error.message;
                throw this.error;
            }
        },
    },
});
