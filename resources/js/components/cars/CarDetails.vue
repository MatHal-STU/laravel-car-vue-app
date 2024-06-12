<template>
    <div class="bg-white relative border rounded-lg p-5 ">
        <h1 class="text-xl font-bold mb-4">Car Details</h1>
        <div v-if="car">
            <div v-if="!isEditing">
                <p><strong>Name:</strong> {{ car.name }}</p>
                <p><strong>Registration Number:</strong> {{ car.registration_number }}</p>
                <p><strong>Is Registered:</strong> {{ car.is_registered ? 'Yes' : 'No' }}</p>
                <button class="btn btn-secondary mt-4" @click="isEditing = true">Update</button>
            </div>
            <div v-else>
                <form @submit.prevent="updateCar">
                    <div class="mb-3">
                        <label for="editCarName" class="form-label">Name</label>
                        <input type="text" id="editCarName" name="car-name" class="form-control" v-model="editCar.name" autocomplete="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCarRegistrationNumber" class="form-label">Registration Number</label>
                        <input type="text" id="editCarRegistrationNumber" name="registration-number" class="form-control" v-model="editCar.registration_number" autocomplete="off" :required="editCar.is_registered">
                    </div>
                    <div class="mb-3">
                        <label for="editCarIsRegistered" class="form-label">Is Registered</label>
                        <select id="editCarIsRegistered" name="is-registered" class="form-control" v-model="editCar.is_registered" autocomplete="off" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" @click="cancelEdit">Cancel</button>
                </form>
            </div>
        </div>
        <router-link class="btn btn-primary mt-4" to="/cars">Back to Cars</router-link>
    </div>
</template>

<script>
export default {
    name: 'CarDetails',
    data() {
        return {
            car: null,
            isEditing: false,
            editCar: {
                name: '',
                registration_number: '',
                is_registered: '0',
            },
        };
    },
    async created() {
        const carId = this.$route.params.id;
        try {
            // Fetch the car details
            const response = await axios.get(`/cars/${carId}`);
            this.car = response.data;
            this.editCar.name = this.car.name;
            this.editCar.registration_number = this.car.registration_number;
            this.editCar.is_registered = this.car.is_registered ? '1' : '0';
        } catch (error) {
            console.error('Error fetching car details:', error);
        }
    },
    methods: {
        async updateCar() {
            try {
                await axios.put(`/cars/${this.car.id}`, this.editCar);
                this.car.name = this.editCar.name;
                this.car.registration_number = this.editCar.registration_number;
                this.car.is_registered = this.editCar.is_registered === '1';
                this.isEditing = false;
            } catch (error) {
                console.error('Error updating car details:', error);
            }
        },
        cancelEdit() {
            this.isEditing = false;
            this.editCar.name = this.car.name;
            this.editCar.registration_number = this.car.registration_number;
            this.editCar.is_registered = this.car.is_registered ? '1' : '0';
        },
    },
};
</script>