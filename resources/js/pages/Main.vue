<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-5 shadow rounded p-4 text-center">
            <h2 class="mb-3">Bienvenido/a <span>{{ authStore.user?.name  }}</span>!</h2>
            <p v-if="authStore.user?.isAdmin" class="lead text-muted">
                Aqui podras gestionar a los usuarios, las aplicaciones y sus permisos
            </p>
            <template v-else>
                <p>Tienes acceso a la siguientes aplicaciones:</p>
                <ul>
                    <li>Clients CRM v2</li>
                </ul>
                <strong>TODO: Mostrar un mosaico con las aplicaciones?</strong>
            </template>
        </div>
    </div>

</template>

<script>
import {authStore} from "../stores/auth.js";
import {mapStores} from "pinia";

export default {
    name: "Main",
    computed: {
        ...mapStores(authStore)
    }
}
</script>

<style scoped>

</style>
