<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import CategoryTable from "../components/CategoryTable.vue";
import CreateCategory from "../components/CreateCategory.vue";

const categories = ref([]);
const selectedCategory = ref(null);

// api integration
const fetchCategories = async () => {
    try {
        const response = await axios.get("/api/category");
        categories.value = response.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

// to load on render
onMounted(fetchCategories);
const handleCategorySaved = () => {
    selectedCategory.value = null;
    fetchCategories();
};

const handleEditCategory = (category) => {
    selectedCategory.value = category;
};
</script>

<template>
    <div>
        <h1 class="text-primary">Category View</h1>

        <CreateCategory
            :category="selectedCategory"
            @category-saved="handleCategorySaved"
        />

        <CategoryTable
            :categories="categories"
            @refresh="fetchCategories"
            @edit-category="handleEditCategory"
        />
    </div>
</template>

<style>
.container {
    max-width: 900px;
    margin: auto;
}
</style>
