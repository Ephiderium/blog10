import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import '../css/app.css'
require('./bootstrap');

const app = createApp(App);
app.use(createPinia());
app.use(router);
app.mount('#app');
