import './bootstrap';
import { createApp } from 'vue';
import App from "./App.vue";
import router from "./router/index.js";
import { createPinia } from "pinia";
import * as bootstrap from 'bootstrap'

createApp(App)
    .use(router)
    .use(createPinia())
    .mount('#app');
