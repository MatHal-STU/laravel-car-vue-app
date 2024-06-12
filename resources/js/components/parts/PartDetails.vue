<template>
    <div class="bg-white relative border rounded-lg p-5 ">
        <h1 class="text-xl font-bold mb-4">Part Details</h1>
        <div v-if="part">
            <div v-if="!isEditing">
                <p><strong>Name:</strong> {{ part.name }}</p>
                <p><strong>Serial Number:</strong> {{ part.serialnumber }}</p>
                <p><strong>Car Name:</strong> {{ part.car ? part.car.name : 'N/A' }}</p>
                <button class="btn btn-secondary mt-4" @click="isEditing = true">Update</button>
            </div>
            <div v-else>
                <form @submit.prevent="updatePart">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" v-model="editPart.name" required>
                    </div>
                    <div class="mb-3">
                        <label for="serialnumber" class="form-label">Serial Number</label>
                        <input type="text" class="form-control" v-model="editPart.serialnumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="car_id" class="form-label">Car</label>
                        <select class="form-control" v-model="editPart.car_id" required>
                            <option v-for="car in cars" :key="car.id" :value="car.id">
                                {{ car.name }}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" @click="cancelEdit">Cancel</button>
                </form>
            </div>
        </div>
        <router-link class="btn btn-primary mt-4" to="/parts">Back to Parts</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'PartDetails',
    data() {
        return {
            part: null,
            cars: [],
            isEditing: false,
            editPart: {
                name: '',
                serialnumber: '',
                car_id: null,
            },
        };
    },
    async created() {
        const partId = this.$route.params.id;
        try {
            // Fetch the part details
            const response = await axios.get(`/parts/${partId}`);
            this.part = response.data;
            this.editPart.name = this.part.name;
            this.editPart.serialnumber = this.part.serialnumber;
            this.editPart.car_id = this.part.car ? this.part.car.id : null;

            // Fetch the list of cars
            const carsResponse = await axios.get('/cars');
            this.cars = carsResponse.data;
        } catch (error) {
            console.error('Error fetching part details:', error);
        }
    },
    methods: {
        async updatePart() {
            try {
                await axios.put(`/parts/${this.part.id}`, this.editPart);
                this.part.name = this.editPart.name;
                this.part.serialnumber = this.editPart.serialnumber;
                this.part.car = this.cars.find(car => car.id === this.editPart.car_id);
                this.isEditing = false;
            } catch (error) {
                console.error('Error updating part details:', error);
            }
        },
        cancelEdit() {
            this.isEditing = false;
            this.editPart.name = this.part.name;
            this.editPart.serialnumber = this.part.serialnumber;
            this.editPart.car_id = this.part.car ? this.part.car.id : null;
        },
    },
};
</script>