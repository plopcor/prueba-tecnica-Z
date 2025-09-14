<template>

    <OffCanvas
        v-bind="$attrs"
        @close="close"
        title="Añadir usuario"
    >

        <form @submit.prevent="create">
            <div class="form-floating mb-2">
                <input v-model="user.username" type="text" class="form-control" id="username" placeholder="Usuario">
                <label for="username">Usuario</label>
            </div>

            <div class="form-floating mb-2">
                <input v-model="user.name" type="text" class="form-control" id="name" placeholder="Nombre">
                <label for="name">Nombre</label>
            </div>

            <div class="form-floating mb-2">
                <input v-model="user.surname" type="text" class="form-control" id="surname" placeholder="Apellidos">
                <label for="surname">Apellidos</label>
            </div>

            <div class="form-floating mb-2">
                <input v-model="user.email" type="text" class="form-control" id="email" placeholder="Email">
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-2">
                <!--  type="password" -->
                <input v-model="user.password" type="text" class="form-control" id="password" placeholder="Contraseña">
                <label for="password">Contraseña</label>
            </div>

            <div class="form-floating mb-2">
                <input v-model="user.hire_date" type="date" class="form-control" id="hireDate">
                <label for="hireDate">Fecha contratacion</label>
            </div>

            <div class="form-floating mb-2">
                <input v-model="user.department" type="text" class="form-control" id="department" placeholder="Departamento">
                <label for="department">Departamento</label>
            </div>

            <div class="form-floating mb-2">
                <input v-model="user.position" type="text" class="form-control" id="position" placeholder="Posicion">
                <label for="position">Posicion</label>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>

        </form>

    </OffCanvas>

</template>

<script>
import OffCanvas from "./OffCanvas.vue";
import { mapStores } from "pinia";
import { usersStore } from "../stores/users.js";

export default {
    name: "UserAdd",
    components: {OffCanvas},
    emits: ['created'],
    data() {
        return {
            user: {}
        }
    },
    computed: {
        ...mapStores(usersStore)
    },
    methods: {
        async create() {
            try {
                await this.usersStore.add(this.user);
                this.close();
            } catch (error) {
                alert(error)
            }

        },
        close() {
            this.$emit('close');
        }
    }
}
</script>

<style scoped>

</style>
