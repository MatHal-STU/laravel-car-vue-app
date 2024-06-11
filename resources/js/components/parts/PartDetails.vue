<template>
    <div class="bg-white relative border rounded-lg p-6">
      <h1 class="text-xl font-bold mb-4">Part Details</h1>
      <div v-if="part">
        <p><strong>ID:</strong> {{ part.id }}</p>
        <p><strong>Name:</strong> {{ part.name }}</p>
        <p><strong>Serial Number:</strong> {{ part.serialnumber }}</p>
        <p><strong>Car Name:</strong> {{ part.car ? part.car.name : 'N/A' }}</p>
      </div>
      <router-link class="btn btn-primary mt-4" to="/parts">Back to Parts</router-link>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'PartDetails',
    data() {
      return {
        part: null,
      };
    },
    async created() {
      const partId = this.$route.params.id;
      try {
        const response = await axios.get(`/parts/${partId}`);
        this.part = response.data;
      } catch (error) {
        console.error('Error fetching part details:', error);
      }
    },
  };
  </script>
  

  