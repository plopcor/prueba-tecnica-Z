<template>
    <nav>
        <RouterLink to="/applications">Ver Aplicaciones</RouterLink>
        <RouterLink to="/users">Ver Usuarios</RouterLink>
    </nav>
    <main>
        <RouterView />
    </main>
</template>

<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>
