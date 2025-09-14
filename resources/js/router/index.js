import { createRouter, createWebHistory } from 'vue-router';

import Login from "../pages/Login.vue";
import Users from "../pages/Users.vue";
import Applications from "../pages/Applications.vue";
import Main from "../pages/Main.vue";
import { authStore } from "../stores/auth.js";
import {applicationsStore} from "../stores/applications.js";

const routes = [
    { path: '/login', name: 'Login', component: Login },
    { path: '/', name: 'Main', component: Main,
        meta: { requiresAuth: true }
    },
    { path: '/applications', name: 'Applications', component: Applications,
        meta: { requiresAuth: true }
    },
    { path: '/users', name: 'Users', component: Users,
        meta: { requiresAuth: true, requiresAdmin: true }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Route guards
router.beforeEach(async (to, from, next) => {
    const auth = authStore();
    const appStore = applicationsStore();

    // Try to load user once (maybe session cookie is set)
    if (!auth.isAuthenticated && !auth.init) {
        await auth.getUser();
    }

    // Load applications
    if (auth.isAuthenticated && !appStore.init) {
        await appStore.getAll();
    }

    // Redirect from "/login" to "/" if already logged in
    if (to.name == 'Login' && auth.isAuthenticated) {
        next({ name: 'Main'});
        return false;
    }

    if (to.meta.requiresAuth) {
        if (!auth.isAuthenticated) {
            next({ name: 'Login' })
            return false;
        }
        if (to.meta.requiresAdmin && !auth.isAdmin) {
            // TODO: Return "error: not authorized"
            next({ name: 'Login' })
            return false;
        }
    }

    next();
});

export default router;
