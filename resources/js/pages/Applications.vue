<template>
    <div class="container col-12 col-md-8 shadow pt-2">

        <ApplicationAdd
            v-if="showAddModal"
            :show="showAddModal"
            @close="showAddModal = false"
            :application="selectedApp"
        ></ApplicationAdd>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Aplicaciones</h3>
            <div>
                <button @click="create" type="button" class="btn btn-success me-2">Añadir</button>
<!--                <button type="button" class="btn btn-secondary">Otro</button>-->
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Enlace</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(app, index) of applicationsStore.applications">
                    <td>{{ app.name }}</td>
                    <td><a v-if="app.url" :href="app.url" target="_blank" class="text-decoration-none">{{ app.url }}</a></td>
                    <td><span :style="{ 'background-color': app.isActive ? 'bg-success' : 'bg-alert' }"></span>{{ app.is_active ? 'Activa' : 'Inactiva' }}</td>
                    <td>
                        <button @click="edit(app)" class="btn p-0 border-0 bg-transparent text-primary mr-2" title="Editar">
                            <i class="bi bi-pencil-square fs-6"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import ApplicationAdd from "../components/ApplicationAdd.vue";
import { mapStores } from "pinia";
import { applicationsStore } from "../stores/applications.js";

export default {
    name: "Applications",
    components: {ApplicationAdd},
    data() {
        return {
            showAddModal: false,
            selectedApp: null,
            // applications: this.applicationsStore.applications
        }
    },
    computed: {
        ...mapStores(applicationsStore)
    },
    methods: {
        create() {
            this.selectedApp = null;
            this.showAddModal = true;
        },
        edit(application) {
            this.selectedApp = application;
            this.showAddModal = true;
        }
    }
}
</script>

<style scoped>

</style>
