<template>
    <div class="container col-12 col-md-8">

        <!-- TODO: ADD MODAL TO EDIT OR CREATE -->

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Usuarios</h4>
            <div>
                <button type="button" class="btn btn-success me-2">Añadir</button>
                <!--                <button type="button" class="btn btn-secondary">Otro</button>-->
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover shadow">
                <thead>
                <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user, index) of users">
                    <td>{{ user.username }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.surnames }}</td>
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
    name: "Users",
    data() {
        return {
            users: [
                { id: 1, username: 'jdoe', email: 'empresa1@mail.com', name: "John", surnames: "Doe Prueba"},
                { id: 2, username: 'jaet', email: 'jnet@mail.com', name: "Jannet", surnames: "John Bak"}
            ]
        }
    }
}
</script>

<style scoped>

</style>
