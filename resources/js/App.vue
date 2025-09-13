<template>

    <NavHeader />

    <main class="container">
        <RouterView />
    </main>
</template>

<script>
import NavHeader from "./components/NavHeader.vue";

export default {
    name: "App",
    components: {
        NavHeader
    }
}
</script>

<style scoped>

</style>
