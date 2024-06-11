import { createRouter, createWebHistory } from "vue-router";
import Cars from '../inventory/Cars.vue';
import Parts from '../inventory/Parts.vue';
import CreateCar from '../inventory/CreateCar.vue';
import CreatePart from '../inventory/CreatePart.vue';

const routes = [
    { path: '/', redirect: '/cars' },
    { path: '/cars', component: Cars },
    { path: '/parts', component: Parts },
    { path: '/cars/create', component: CreateCar },
    { path: '/parts/create', component: CreatePart },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;