<template>
    <div class="container col-12 col-md-8 shadow pt-2">

        <!-- TODO: ADD MODAL TO EDIT OR CREATE -->

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Aplicaciones</h3>
            <div>
                <button type="button" class="btn btn-success me-2">Añadir</button>
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
                <tr v-for="(app, index) of applications">
                    <td>{{ app.name }}</td>
                    <td><a v-if="app.url" :href="app.url" target="_blank" class="text-decoration-none">{{ app.url }}</a></td>
                    <td><span :style="{ 'background-color': app.isActive ? 'bg-success' : 'bg-alert' }"></span>{{ app.isActive ? 'Activa' : 'Inactiva' }}</td>
                    <td>
                        <button class="btn p-0 border-0 bg-transparent text-primary mr-2" title="Editar">
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
export default {
    name: "Applications",
    data() {
        return {
            applications: [
                { id: 1, name: "DevTools v1", url: "https://google.com", isActive: false},
                { id: 2, name: "Client CRM", url: "https://google.com", isActive: true}
            ]
        }
    }
}
</script>

<style scoped>

</style>
