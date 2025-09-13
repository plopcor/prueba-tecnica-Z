<template>
    <div v-if="authStore.isAuthenticated" class="container">
        <nav class="d-flex shadow rounded justify-content-between py-2 px-2 my-4 ">
            <ul class="nav nav-pills">
                <li class="nav-item"><RouterLink to="/" class="nav-link" active-class="active">Panel</RouterLink></li>
                <li class="nav-item"><RouterLink to="/applications" class="nav-link" active-class="active">Aplicaciones</RouterLink></li>
                <li class="nav-item"><RouterLink to="/users" class="nav-link" active-class="active">Usuarios</RouterLink></li>
            </ul>
            <div>
                <div class="mt-2">
                    <span class="mx-2">{{ authStore.user.username }}</span>
                    <button @click="logout" class="btn p-0 border-0 bg-transparent">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                    </button>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapStores } from "pinia";
import { authStore } from "../stores/auth.js";
import router from "../router/index.js";

export default {
    name: "NavHeader",
    computed: {
        ...mapStores(authStore)
    },
    methods: {
        async logout() {
            await this.authStore.logout();
            await router.push({ name: "Login" });
        }
    }
}
</script>

<style scoped>

</style>
