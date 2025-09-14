<template>

    <OffCanvas
        v-bind="$attrs"
        @close="$emit('close')"
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
                    Aplicaciones
                </button>
            </li>
        </ul>

        <div class="tab-content flex-grow-1 overflow-auto pt-3">

            <!-- Datos usuario -->
            <div class="tab-pane fade show active" id="data" role="tabpanel">
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
            <div class="tab-pane fade" id="permissions" role="tabpanel">
                <div class="scrollable-checkbox-list border rounded px-3 py-2">
                    <div class="mb-2 text-muted">Aplicaciones</div>
                    <div v-for="(app, index) of applications" class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" :id="'app_check_' + index">
                        <label class="form-check-label" :for="'app_check_' + index">{{ app.name }}</label>
                    </div>
                </div>
            </div>
        </div>



        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Modificar</button>
        </div>

    </OffCanvas>

</template>

<script>
import OffCanvas from "./OffCanvas.vue";

export default {
    name: "UserEdit",
    components: {OffCanvas},
    props: {
        user: {
            type: Object,
            required: true,
            default: null
        }
    },
    data() {
        return {
            applications: [
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "Internal Tools" },
                { id:1, name: "CRM v1" }
            ],
        }
    }
}
</script>

<style scoped>

</style>
