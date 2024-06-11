/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import { createApp } from 'vue';
import App from './components/ExampleComponent.vue';
import router from './components/router';
import vuetify from './vuetify';

const app = createApp(App);

app.use(router);
app.use(vuetify);
app.mount('#app');