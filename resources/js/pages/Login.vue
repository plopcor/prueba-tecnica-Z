<template>
    <strong>Usuario y contraseña</strong>

    <h4>Inicia sesión en tu cuenta</h4>

    <div class="form-floating mb-3">
        <input v-model="username" type="text" class="form-control" id="username" placeholder="email@example.com">
        <label for="username">Usuario</label>
    </div>
    <div class="form-floating">
        <input v-model="password" type="password" class="form-control" id="password" placeholder="Contraseña">
        <label for="password">Contraseña</label>
    </div>

    <button type="button" class="btn" @click="login">Acceder</button>

</template>

<script>
import router from "../router/index.js";
import { authStore } from "../stores/auth.js";
import { mapStores } from 'pinia';

export default {
    name: "Login",
    data() {
        return {
            username: "julia_perez",
            password: "admin1234",
            error: false
        };
    },
    computed: {
        ...mapStores(authStore),
    },
    methods: {
        async login() {
            if (!this.username.trim() || !this.password.trim()) {
                return;
            }

            let res = await this.authStore.login(this.username, this.password);
            if (res) {
                await router.push({ name: "Main" });
                return;
            } else {
                this.password = "";
                this.error = true;
            }
        }
    },

}
</script>

<style scoped>

</style>
