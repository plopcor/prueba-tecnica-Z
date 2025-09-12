import { createRouter, createWebHistory } from 'vue-router';

import Login from "../pages/Login.vue";
import Users from "../pages/Users.vue";
import Applications from "../pages/Applications.vue";
import Main from "../pages/Main.vue";

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
    let authenticated = true; // TESTING
    let isAdmin = false; // TESTING
    if (to.meta.requiresAuth) {
        if (!authenticated) {
            next({ name: 'Login' })
            return false;
        }
        if (to.meta.requiresAdmin && !isAdmin) {
            // TODO: Return "error: not authorized"
            next({ name: 'Login' })
            return false;
        }

        // Redirect from "/login" to "/" if already logged in
        if (to.name == 'Login') {
            next({ name: 'Main'});
            return false;
        }
    }
    next();
});

export default router;
