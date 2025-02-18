<script setup>
import { ref, defineEmits } from 'vue';
import axios from 'axios';

const name = ref('');
const description = ref('');
const emit = defineEmits(['category-added']);

const addCategory = async () => {
    try {
        await axios.post('/category/postCategory', {
            name: name.value,
            description: description.value
        });
        name.value = '';
        description.value = '';
        emit('category-added');
    } catch (error) {
        console.error("Error adding category:", error);
    }
};
</script>

<template>
    <form @submit.prevent="addCategory" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input v-model="name" type="text" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input v-model="description" type="text" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</template>
