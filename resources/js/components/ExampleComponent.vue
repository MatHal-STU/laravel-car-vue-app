<template>
    <v-app>
        <NavBar />
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
import NavBar from './NavBar.vue';

export default {
    name: 'ExampleComponent',
    components: {
        NavBar,
    },
    mounted() {
        console.log('Component mounted.')
    }
};
</script>
