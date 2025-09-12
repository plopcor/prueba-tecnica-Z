import { createRouter, createWebHistory } from 'vue-router';

import Login from "../pages/Login.vue";
import Users from "../pages/Users.vue";
import Applications from "../pages/Applications.vue";

const routes = [
    { path: '/login', name: 'login', component: Login },
    { path: '/applications', name: 'applications', component: Applications },
    { path: '/users', name: 'users', component: Users },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
