<template>
  <div class="bg-white relative border rounded-lg p-5">
    <h1>Add New Car</h1>
    <form @submit.prevent="submitForm" novalidate>
      <div class="mb-3">
        <label for="name" class="form-label">Car Name</label>
        <input type="text" id="name" class="form-control" v-model="car.name" :class="{ 'is-invalid': isSubmitted && !car.name }" required>
        <div class="invalid-feedback">
          Car name is required.
        </div>
      </div>
      <div class="mb-3">
        <label for="registration_number" class="form-label">Registration Number</label>
        <input type="text" id="registration_number" class="form-control" v-model="car.registration_number" :class="{ 'is-invalid': isSubmitted && car.is_registered === '1' && !car.registration_number }" :required="car.is_registered === '1'">
        <div class="invalid-feedback">
          Registration number is required when the car is registered.
        </div>
      </div>
      <div class="mb-3">
        <label for="is_registered" class="form-label">Is Registered</label>
        <select id="is_registered" class="form-control" v-model="car.is_registered" :class="{ 'is-invalid': isSubmitted && !car.is_registered }" required>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
        <div class="invalid-feedback">
          Please select registration status.
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Add Car</button>
      <router-link class="btn btn-secondary ml-2" to="/cars">Back</router-link>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      car: {
        name: '',
        registration_number: '',
        is_registered: '0'
      },
      isSubmitted: false
    };
  },
  methods: {
    async submitForm() {
      this.isSubmitted = true;
      if (!this.car.name || (this.car.is_registered === '1' && !this.car.registration_number)) {
        return;
      }
      try {
        await axios.post('/cars', this.car);
        this.$router.push('/cars');
      } catch (error) {
        console.error('Error adding car:', error);
      }
    }
  }
};
</script>
