<template>
    <header v-if="authStore.isAuthenticated" class="p-2 mb-3"> <!-- border-bottom -->
        <div class="container col-6">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <!-- nav-pills -->
                <ul class="nav col-8 col-md-10 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><RouterLink to="/" class="nav-link active">Panel</RouterLink></li>
                    <li><RouterLink to="/applications" class="nav-link">Aplicaciones</RouterLink></li>
                    <li><RouterLink to="/users" class="nav-link">Usuarios</RouterLink></li>
                </ul>
                <div class="col-4 col-md-2 mb-2 mb-md-0">
                    <span>@Username <i class="bi bi-box-arrow-right"></i></span>
                    <!-- Bootstrap 5 "Box arrow right" -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                    <!--                    <button type="button" class="btn btn-danger">Logout</button>-->
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import { mapStores } from "pinia";
import { authStore } from "../stores/auth.js";

export default {
    name: "NavHeader",
    computed: {
        ...mapStores(authStore)
    }
}
</script>

<style scoped>

</style>
