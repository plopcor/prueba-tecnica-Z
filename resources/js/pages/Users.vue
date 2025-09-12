<template>
    <div class="container col-12 col-md-8">

        <!-- TODO: ADD MODAL TO EDIT OR CREATE -->

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Usuarios</h1>
            <div>
                <button type="button" class="btn btn-success me-2">Crear</button>
                <!--                <button type="button" class="btn btn-secondary">Otro</button>-->
            </div>
        </div>

        <table class="table">
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
                <th scope="row">{{ user.username }}</th>
                <td>{{ user.email }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.surnames }}</td>
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
    name: "Users",
    data() {
        return {
            users: [
                { id: 1, username: 'jdoe', email: 'empresa1@mail.com', name: "John", surnames: "Doe Prueba"}
            ]
        }
    }
}
</script>

<style scoped>

</style>
