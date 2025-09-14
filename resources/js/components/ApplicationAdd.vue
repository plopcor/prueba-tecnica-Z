<template>

    <OffCanvas
        v-bind="$attrs"
        @close="close"
        :title="(isEdit ? 'Editar' : 'Añadir') + ' aplicacion'"
    >

        <div class="form-floating mb-2">
            <input v-model="app.name" type="text" class="form-control" id="name" placeholder="Nombre">
            <label for="name">Nombre</label>
        </div>

        <div class="form-floating mb-2">
            <input v-model="app.url" type="text" class="form-control" id="url" placeholder="URL">
            <label for="url">URL</label>
        </div>

        <div class="form-check form-switch">
            <input v-model="app.is_active" class="form-check-input" type="checkbox" role="switch" id="active">
            <label class="form-check-label" for="active">Activa</label>
        </div>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>

    </OffCanvas>

</template>

<script>
import OffCanvas from "./OffCanvas.vue";
import { mapStores } from "pinia";
import { applicationsStore } from "../stores/applications.js";

export default {
    name: "ApplicationAdd",
    components: {OffCanvas},
    emits: ['close', 'created'],
    props: {
        application: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            app: null
        }
    },
    computed: {
        isEdit() {
            return this.application != null;
        },
        ...mapStores(applicationsStore)
    },
    methods: {
        async create() {
            if (this.app.id) {
                await this.applicationsStore.update(this.app.id, this.app);
            } else {
                // Create
                await this.applicationsStore.add(this.app);
            }
            this.$emit('created');
            this.close();
        },
        close() {
            this.$emit('close');
        }
    },
    watch: {
        application: {
            immediate: true,
            handler(newApp) {
                if (newApp) {
                    this.app = {...newApp};
                } else {
                    this.app = {
                        name: "",
                        url: "",
                        is_active: true
                    }
                }
            },
        },
    }
}
</script>

<style scoped>

</style>
