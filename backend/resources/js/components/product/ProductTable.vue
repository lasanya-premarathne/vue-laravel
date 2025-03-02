<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    products: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['edit', 'delete']);

const getCategoryName = (categoryId) => {
    const category = props.categories.find(cat => cat.id === categoryId);
    return category ? category.name : 'Unknown Category';
};
</script>

<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>${{ product.unit_price }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ getCategoryName(product.category_id) }}</td>
                    <td>
                        <button 
                            @click="emit('edit', product)"
                            class="btn btn-sm btn-primary me-2"
                        >
                            Edit
                        </button>
                        <button 
                            @click="emit('delete', product.id)"
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