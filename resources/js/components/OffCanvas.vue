<template>
    <!-- NOTA: Creado Offcanvas manual para controlarlo mejor y no instalar VueBootstrapNext -->
    <div
        v-if="show"
        class="offcanvas offcanvas-end shadow"
        :class="{ 'show': show }"
        tabindex="-1"
        style="visibility: visible;"
    >
        <div class="offcanvas-header">
            <h5 v-if="title" class="offcanvas-title">{{ title }}</h5>
            <button type="button" class="btn-close" @click="close"></button>
        </div>
        <div class="offcanvas-body">
            <slot>

            </slot>
        </div>
    </div>

    <div v-if="show" @click="close" class="offcanvas-backdrop fade" :class="{ 'show': show }"></div>
</template>

<script>
export default {
    name: "OffCanvas",
    emits: ['close'],
    props: {
        title: {
            type: String,
            default: null
        },
        show: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        close() {
            this.$emit('close');
        },
        done() {
            this.$emit('done');
        }
    }
}
</script>

<style scoped>

</style>
