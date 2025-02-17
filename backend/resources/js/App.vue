<script setup>
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import CategoryTable from './components/CategoryTable.vue';

    const categories = ref([]);

    // api integration
    const fetchCategories = async () => {
    try {
        const response = await axios.get('/category/getAll');
        categories.value = response.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
    };

    // to load on render
    onMounted(fetchCategories);
</script>

<template>
    <div class="container mt-4">
        <h1 class="text-primary">Category View</h1>

        <CategoryTable :categories="categories" @refresh="fetchCategories" />
        
    </div>
</template>

<style>
.container {
    max-width: 900px;
    margin: auto;
}
</style>
