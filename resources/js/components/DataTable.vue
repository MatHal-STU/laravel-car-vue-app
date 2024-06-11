<script setup>
defineProps( {
    items: {
        type: Array,
    }
})

</script>

<template>
    <table>
        <tr v-for="item in items" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.registration_number }}</td>
            <td>{{ item.is_registered ? 'Yes' : 'No' }}</td>
        </tr>
    </table>
</template>