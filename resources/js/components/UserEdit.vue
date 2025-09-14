<template>

    <OffCanvas
        v-bind="$attrs"
        @close="close"
        title="Editar usuario"
    >

        <ul class="nav nav-tabs" id="userTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab">
                    Datos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="perm-tab" data-bs-toggle="tab" data-bs-target="#permissions" type="button" role="tab">
                    Permisos
                </button>
            </li>
        </ul>

        <form @submit.prevent="create">
            <div class="tab-content flex-grow-1 overflow-auto pt-3">

                    <!-- Datos usuario -->
                    <div class="tab-pane fade show px-1 active" id="data" role="tabpanel">

                        <div class="form-floating mb-2">
                            <input :value="user.username" type="text" class="form-control readonly" id="username" placeholder="Usuario" readonly>
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
                    </div>

                    <!-- Permiso aplicaciones -->
                    <div class="tab-pane px-1 fade" id="permissions" role="tabpanel">
                        <div class="scrollable-checkbox-list border rounded px-3 py-2">
                            <div class="mb-2 text-muted">Aplicaciones</div>
                            <div v-for="(app, index) of applicationsStore.applications" class="form-check mb-2">
                                <input :value="app.id" v-model="user.applications" class="form-check-input" type="checkbox" :id="'app_check_' + index">
                                <label class="form-check-label" :for="'app_check_' + index">{{ app.name }}</label>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </form>

    </OffCanvas>

</template>

<script>
import OffCanvas from "./OffCanvas.vue";
import { mapStores } from "pinia";
import { usersStore } from "../stores/users.js";
import { applicationsStore } from "../stores/applications.js";

export default {
    name: "UserEdit",
    components: {OffCanvas},
    props: {
        user: {
            type: Object,
            default: null
        }
    },
    data() {
        return {

        }
    },
    computed: {
        ...mapStores(usersStore, applicationsStore)
    },
    methods: {
        async create() {
            try {
                if (this.user.id) {
                    await this.usersStore.update(this.user.id, this.user);
                }
                this.$emit('created');
                this.close();
            } catch (error) {
                alert(error);
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
