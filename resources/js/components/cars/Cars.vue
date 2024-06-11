<template>
  <div class="bg-white relative border rounded-lg">
    <h1 class="text-xl font-bold p-6">Cars</h1>
    <router-link class="btn btn-primary ml-6" to="/cars/create">Add New Car</router-link>
    <button class="btn btn-danger ml-4" @click="deleteSelected">Delete Selected</button>
    <table class="w-full text-sm text-left text-gray-500 mt-6">
      <thead class="text-xs text-gray-700 uppercase bg-gray">
        <tr>
          <th class="px-4 py-3" scope="col"><input type="checkbox" @change="toggleSelectAll" v-model="selectAll"></th>
          <th class="px-4 py-3" scope="col">ID</th>
          <th class="px-4 py-3" scope="col">Name</th>
          <th class="px-4 py-3" scope="col">Registration Number</th>
          <th class="px-4 py-3" scope="col">Is Registered</th>
          <th scope="col" class="sr-only">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="car in cars" :key="car.id" class="border-b">
          <td class="px-4 py-3"><input type="checkbox" v-model="selectedCars" :value="car.id"></td>
          <td class="px-4 py-3 font-medium text-gray-900">{{ car.id }}</td>
          <td class="px-4 py-3 font-medium text-gray-900">{{ car.name }}</td>
          <td class="px-4 py-3">{{ car.registration_number }}</td>
          <td class="px-4 py-3">{{ car.is_registered ? 'Yes' : 'No' }}</td>
          <td class="px-4 py-3 flex items-center justify-end">
            <router-link :to="'/cars/' + car.id" class="text-indigo-500 hover:underline">Details</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Cars',
  data() {
    return {
      cars: [],
      selectedCars: [],
      selectAll: false,
    };
  },
  async created() {
    try {
      const response = await axios.get('/cars');
      this.cars = response.data;
    } catch (error) {
      console.error('Error fetching cars:', error);
    }
  },
  watch: {
    selectedCars: {
      handler(val) {
        this.selectAll = val.length === this.cars.length;
      },
      deep: true,
    },
  },
  methods: {
    toggleSelectAll() {
      if (this.selectAll) {
        this.selectedCars = this.cars.map(car => car.id);
      } else {
        this.selectedCars = [];
      }
    },
    async deleteSelected() {
      try {
        for (let carId of this.selectedCars) {
          await axios.delete(`/cars/${carId}`);
        }
        this.selectedCars = [];
        const response = await axios.get('/cars');
        this.cars = response.data;
      } catch (error) {
        console.error('Error deleting cars:', error);
      }
    },
  },
};
</script>