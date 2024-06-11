<template>
  <div class="bg-white relative border rounded-lg p-5 ">
    <h1 class="text-xl font-bold mb-4">Cars</h1>
    <form class="py-3 px4 flex items-center">
      <label class="sr-only">Search</label>
      <div class="ralative w-full">
        <input type="text" v-model="searchQuery" class="form-control" placeholder="Search">
      </div>
    </form>
    <router-link class="btn btn-primary mb-4" to="/cars/create">Add New Car</router-link>
    <button class="btn btn-danger mb-4" @click="deleteSelected">Delete Selected</button>
    <table class="w-full text-sm text-left text-gray-500 mt-6">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          <th scope="col"><input type="checkbox" @change="toggleSelectAll" v-model="selectAll"></th>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Registration Number</th>
          <th scope="col">Is Registered</th>
          <th scope="col" class="sr-only">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="car in filteredCars" :key="car.id" class="border-b">
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
      searchQuery: '',
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
  computed: {
    filteredCars() {
      return this.cars.filter(car => {
        return (
          car.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          car.registration_number.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      });
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

