import { createRouter, createWebHistory } from "vue-router";
import Cars from '../cars/Cars.vue';
import Parts from '../parts/Parts.vue';
import CreateCar from '../cars/CreateCar.vue';
import CreatePart from '../parts/CreatePart.vue';
import PartDetails from '../parts/PartDetails.vue';
import CarDetails from '../cars/CarDetails.vue';

const routes = [
    { path: '/', redirect: '/cars' },
    { path: '/cars', component: Cars },
    { path: '/cars/create', component: CreateCar },
    { path: '/cars/:id', component: CarDetails },
    { path: '/parts', component: Parts },
    { path: '/parts/create', component: CreatePart },
    { path: '/parts/:id', component: PartDetails },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;