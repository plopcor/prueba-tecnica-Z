import { createRouter, createWebHistory } from 'vue-router';

import Login from "../pages/Login.vue";
import Users from "../pages/Users.vue";
import Applications from "../pages/Applications.vue";

const routes = [
    { path: '/login', name: 'login', component: Login },
    { path: '/applications', name: 'applications', component: Applications,
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    { path: '/users', name: 'users', component: Users,
        meta: { requiresAuth: true, requiresAdmin: true }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Route guards
router.beforeEach((to, from, next) => {
    let authenticated = false; // TESTING
    let isAdmin = false; // TESTING
    if (to.meta.requiresAuth) {
        if (!authenticated) {
            return { name: 'Login' }
        }
        if (to.meta.requiresAdmin && !isAdmin) {
            // TODO: Return "error: not authorized"
            return { name: 'Login' }
        }
    }
    next();
});

export default router;
