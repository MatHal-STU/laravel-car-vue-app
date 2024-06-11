<template>
  <div class="bg-white relative border rounded-lg">
    <h1 class="text-xl font-bold p-6">Parts</h1>
    <router-link class="btn btn-primary ml-6" to="/parts/create">Add New Part</router-link>
    <button class="btn btn-danger ml-4" @click="deleteSelected">Delete Selected</button>
    <table class="w-full text-sm text-left text-gray-500 mt-6">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          <th class="px-4 py-3"><input type="checkbox" @change="toggleSelectAll" v-model="selectAll"></th>
          <th class="px-4 py-3">ID</th>
          <th class="px-4 py-3">Name</th>
          <th class="px-4 py-3">Serial Number</th>
          <th class="px-4 py-3">Car Name</th>
          <th class="px-4 py-3 sr-only">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="part in parts" :key="part.id" class="border-b">
          <td class="px-4 py-3"><input type="checkbox" v-model="selectedParts" :value="part.id"></td>
          <td class="px-4 py-3 font-medium text-gray-900">{{ part.id }}</td>
          <td class="px-4 py-3 font-medium text-gray-900">{{ part.name }}</td>
          <td class="px-4 py-3">{{ part.serialnumber }}</td>
          <td class="px-4 py-3">{{ part.car ? part.car.name : 'N/A' }}</td>
          <td class="px-4 py-3 flex items-center justify-end">
            <router-link :to="'/parts/' + part.id" class="text-indigo-500 hover:underline">Details</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Parts',
  data() {
    return {
      parts: [],
      selectedParts: [],
      selectAll: false,
    };
  },
  async created() {
    try {
      const response = await axios.get('/parts');
      this.parts = response.data;
    } catch (error) {
      console.error('Error fetching parts:', error);
    }
  },
  watch: {
    selectedParts: {
      handler(val) {
        this.selectAll = val.length === this.parts.length;
      },
      deep: true,
    },
  },
  methods: {
    toggleSelectAll() {
      if (this.selectAll) {
        this.selectedParts = this.parts.map(part => part.id);
      } else {
        this.selectedParts = [];
      }
    },
    async deleteSelected() {
      try {
        for (let partId of this.selectedParts) {
          await axios.delete(`/parts/${partId}`);
        }
        this.selectedParts = [];
        const response = await axios.get('/parts');
        this.parts = response.data;
      } catch (error) {
        console.error('Error deleting parts:', error);
      }
    },
  },
};
</script>