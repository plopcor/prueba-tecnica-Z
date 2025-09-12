<template>
    <div class="container col-12 col-md-8">

        <!-- TODO: ADD MODAL TO EDIT OR CREATE -->

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Aplicaciones</h1>
            <div>
                <button type="button" class="btn btn-success me-2">Crear</button>
<!--                <button type="button" class="btn btn-secondary">Otro</button>-->
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
<!--                <th scope="col">#</th>-->
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
                    <button type="button" class="btn btn-success btn-sm me-2">Editar</button>

                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>
            </tbody>
        </table>

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
