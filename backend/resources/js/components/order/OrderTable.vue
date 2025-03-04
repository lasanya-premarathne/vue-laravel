<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    orders: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['edit', 'delete']);
</script>

<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Contact No</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td>#{{ order.id }}</td>
                    <td>{{ order.customerName }}</td>
                    <td>{{ order.contactNo }}</td>
                    <td>${{ order.totalAmount.toFixed(2) }}</td>
                    <td>
                        <button 
                            @click="emit('edit', order)"
                            class="btn btn-sm btn-primary me-2"
                        >
                            Edit
                        </button>
                        <button 
                            @click="emit('delete', order.id)"
                            class="btn btn-sm btn-danger"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template> 