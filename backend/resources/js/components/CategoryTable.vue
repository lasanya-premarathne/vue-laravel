<script setup>
    import { defineProps, defineEmits } from 'vue';
    import axios from 'axios';

    const props = defineProps({
        categories: Array
    });

    const emit = defineEmits(["refresh"]);

    const deleteCategory = async (id) => {
        if (confirm("Are you sure you want to delete this category?")) {
            try {
                await axios.delete(`/category/${id}/deleteCategory`);
                emit("refresh"); // Reload categories
            } catch (error) {
                console.error("Error deleting category:", error);
            }
        }
    };
</script>

<template>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="category in categories" :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.description }}</td>
                <td>
                    <a :href="'/category/' + category.id + '/edit'" class="btn btn-warning btn-sm">Edit</a>
                    <button @click="deleteCategory(category.id)" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
