<template>
  <div class="bg-white relative border rounded-lg p-5">
    <h1>Add New Part</h1>
    <form @submit.prevent="submitForm" novalidate>
      <div class="mb-3">
        <label for="name" class="form-label">Part Name</label>
        <input type="text" id="name" name="part-name" class="form-control" v-model="part.name" autocomplete="off" :class="{ 'is-invalid': isSubmitted && !part.name }" required>
        <div class="invalid-feedback">
          Part name is required.
        </div>
      </div>
      <div class="mb-3">
        <label for="serialnumber" class="form-label">Serial Number</label>
        <input type="text" id="serialnumber" name="serial-number" class="form-control" v-model="part.serialnumber" autocomplete="off" :class="{ 'is-invalid': isSubmitted && !part.serialnumber }" required>
        <div class="invalid-feedback">
          Serial number is required.
        </div>
      </div>
      <div class="mb-3">
        <label for="car_id" class="form-label">Car</label>
        <select id="car_id" name="car-id" class="form-control" v-model="part.car_id" autocomplete="off" :class="{ 'is-invalid': isSubmitted && !part.car_id }" required>
          <option value="" disabled>Select a car</option>
          <option v-for="car in cars" :value="car.id" :key="car.id">{{ car.name }}</option>
        </select>
        <div class="invalid-feedback">
          Please select a car.
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Add Part</button>
      <router-link class="btn btn-secondary ml-2" to="/parts">Back</router-link>
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
      cars: [],
      isSubmitted: false
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
  methods: {
    async submitForm() {
      this.isSubmitted = true;
      if (!this.part.name || !this.part.serialnumber || !this.part.car_id) {
        return;
      }
      try {
        await axios.post('/parts', this.part);
        this.$router.push('/parts');
      } catch (error) {
        console.error('Error adding part:', error);
      }
    }
  }
};
</script>
