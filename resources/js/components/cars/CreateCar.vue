<template>
    <div>
      <h1>Add New Car</h1>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Car Name</label>
          <input type="text" class="form-control" v-model="car.name" required>
        </div>
        <div class="mb-3">
          <label for="registration_number" class="form-label">Registration Number</label>
          <input type="text" class="form-control" v-model="car.registration_number">
        </div>
        <div class="mb-3">
          <label for="is_registered" class="form-label">Is Registered</label>
          <select class="form-control" v-model="car.is_registered" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Car</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        car: {
          name: '',
          registration_number: '',
          is_registered: '0'
        }
      };
    },
    methods: {
      async submitForm() {
        await axios.post('/cars', this.car);
        this.$router.push('/cars');
      }
    }
  };
  </script>
  