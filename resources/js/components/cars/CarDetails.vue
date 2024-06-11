<template>
    <div class="bg-white relative border rounded-lg p-6">
      <h1 class="text-xl font-bold mb-4">Car Details</h1>
      <div v-if="car">
        <p><strong>ID:</strong> {{ car.id }}</p>
        <p><strong>Name:</strong> {{ car.name }}</p>
        <p><strong>Registration Number:</strong> {{ car.registration_number }}</p>
        <p><strong>Is Registered:</strong> {{ car.is_registered ? 'Yes' : 'No' }}</p>
      </div>
      <router-link class="btn btn-primary mt-4" to="/cars">Back to Cars</router-link>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'CarDetails',
    data() {
      return {
        car: null,
      };
    },
    async created() {
      const carId = this.$route.params.id;
      try {
        const response = await axios.get(`/cars/${carId}`);
        this.car = response.data;
      } catch (error) {
        console.error('Error fetching car details:', error);
      }
    },
  };
  </script>
  
  <style scoped>
  .btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    text-decoration: none;
  }
  </style>
  