<template>
  <div>
    <h1>Cars</h1>
    <router-link class="btn btn-primary" to="/cars/create">Add New Car</router-link>
    <table class="table mt-3">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Registration Number</th>
          <th scope="col">Is Registered</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="car in cars" :key="car.id">
          <td>{{ car.id }}</td>
          <td>{{ car.name }}</td>
          <td>{{ car.registration_number }}</td>
          <td>{{ car.is_registered ? 'Yes' : 'No' }}</td>
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
};
</script>

<style scoped>
.table {
  margin-top: 20px;
}
</style>
