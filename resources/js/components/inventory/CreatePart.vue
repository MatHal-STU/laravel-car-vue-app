<template>
    <div>
      <h1>Add New Part</h1>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Part Name</label>
          <input type="text" class="form-control" v-model="part.name" required>
        </div>
        <div class="mb-3">
          <label for="serialnumber" class="form-label">Serial Number</label>
          <input type="text" class="form-control" v-model="part.serialnumber" required>
        </div>
        <div class="mb-3">
          <label for="car_id" class="form-label">Car</label>
          <select class="form-control" v-model="part.car_id" required>
            <option v-for="car in cars" :value="car.id" :key="car.id">{{ car.name }}</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Part</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        part: {
          name: '',
          serialnumber: '',
          car_id: ''
        },
        cars: []
      };
    },
    async created() {
      const response = await axios.get('/api/cars');
      this.cars = response.data;
    },
    methods: {
      async submitForm() {
        await axios.post('/api/parts', this.part);
        this.$router.push('/parts');
      }
    }
  };
  </script>
  