<template>
    <div class="container col-12 col-md-8 shadow pt-2">

        <UserAdd
            :show="showAddModal"
            @close="showAddModal = false"
        ></UserAdd>

        <UserEdit
            :show="showEditModal"
            @close="showEditModal = false"
            :user="selectedUser"
        ></UserEdit>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Usuarios</h4>
            <div>
                <button @click="create" type="button" class="btn btn-success me-2">Añadir</button>
                <!--                <button type="button" class="btn btn-secondary">Otro</button>-->
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
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
                    <td>{{ user.surname }}</td>
                    <td>
                        <button @click="edit(user)" class="btn p-0 border-0 bg-transparent text-primary me-3" title="Editar">
                            <i class="bi bi-pencil-square fs-6"></i>
                        </button>
                        <button @click="editApps(user)" class="btn p-0 border-0 bg-transparent text-primary" title="Editar">
                            <i class="bi bi-unlock fs-6"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import UserAdd from "../components/UserAdd.vue";
import UserEdit from "../components/UserEdit.vue";

export default {
    name: "Users",
    components: {UserAdd, UserEdit },
    data() {
        return {
            showAddModal: false,
            showEditModal: false,
            showAppsModal: false,
            selectedUser: null,
            users: [
                { id: 1, username: 'jdoe', email: 'empresa1@mail.com', name: "John", surname: "Doe Prueba", apps: [1,2,3]},
                { id: 2, username: 'jaet', email: 'jnet@mail.com', name: "Jannet", surname: "John Bak", apps: [4,5]}
            ]
        }
    },
    methods: {
        create() {
            this.showAddModal = true;
        },
        edit(user) {
            this.selectedUser = user;
            this.showEditModal = true;
        },
        editApps(user) {
            this.selectedUser = user;
            this.showAppsModal = true;
        },
    }
}
</script>

<style scoped>

</style>
