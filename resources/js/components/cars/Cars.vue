<template>
  <div class="bg-white relative border rounded-lg p-5">
    <h1 class="text-xl font-bold mb-4">Cars</h1>
    <form class="py-3 flex items-center">
      <div class="row w-100">
        <div class="col">
          <label for="search" class="sr-only">Search</label>
          <input type="text" id="search" name="search" v-model="searchQuery" class="form-control" placeholder="Search">
        </div>
        <div class="col">
          <label for="filter" class="sr-only">Filter</label>
          <select id="filter" name="filter" v-model="registrationFilter" class="form-control">
            <option value="">All</option>
            <option value="registered">Registered</option>
            <option value="notregistered">Not Registered</option>
          </select>
        </div>
      </div>
    </form>
    <router-link class="btn btn-primary mt-4" to="/cars/create">Add New Car</router-link>
    <button class="btn btn-danger ml-2 mt-4" @click="deleteSelected">Delete Selected</button>
    <table class="w-full text-sm text-left text-gray-500 mt-6 table table-hover">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          <th class="px-4 py-3" scope="col"><input type="checkbox" id="selectAll" @change="toggleSelectAll" v-model="selectAll" name="selectAll"></th>
          <th class="px-4 py-3" scope="col">Name</th>
          <th class="px-4 py-3" scope="col">Registration Number</th>
          <th class="px-4 py-3" scope="col">Is Registered</th>
          <th class="px-4 py-3 sr-only" scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="car in filteredCars" :key="car.id" class="border-b">
          <td class="px-4 py-3"><input type="checkbox" :id="'selectCar' + car.id" v-model="selectedCars" :value="car.id" :name="'selectCar' + car.id"></td>
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
export default {
  name: 'Cars',
  data() {
    return {
      cars: [],
      selectedCars: [],
      selectAll: false,
      searchQuery: '',
      registrationFilter: '',
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
        const name = car.name ? car.name.toLowerCase() : '';
        const registrationNumber = car.registration_number ? car.registration_number.toLowerCase() : '';
        const query = this.searchQuery.toLowerCase();
        const matchesQuery = name.includes(query) || registrationNumber.includes(query);
        const matchesFilter = this.registrationFilter === ''
          || (this.registrationFilter === 'registered' && car.is_registered)
          || (this.registrationFilter === 'notregistered' && !car.is_registered);
        return matchesQuery && matchesFilter;
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
