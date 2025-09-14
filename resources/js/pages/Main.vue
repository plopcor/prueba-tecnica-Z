<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-5 shadow rounded p-4 text-center">
            <h2 class="mb-3">Bienvenido/a <span>{{ authStore.user?.name  }}</span>!</h2>
            <p v-if="authStore.isAdmin" class="lead text-muted">
                Aqui podras gestionar usuarios, aplicaciones y permisos
            </p>
            <template v-else>
                <p>Tienes acceso a la siguientes aplicaciones:</p>
                <ul class="list-unstyled">
                    <li v-for="(app) of ownApps">
                        <a :href="app.url" class="text-decoration-none" target="_blank">{{ app.name }}</a>
                    </li>
                </ul>
            </template>
        </div>
    </div>

</template>

<script>
import { authStore } from "../stores/auth.js";
import { mapStores } from "pinia";

export default {
    name: "Main",
    computed: {
        ...mapStores(authStore),
        ownApps() {
            return [
                { name: "CRM Clientes v2", url: "https://google.com" },
                { name: "Documanager", url: "https://google.com" },
            ];
        }
    }
}
</script>

<style scoped>

</style>
