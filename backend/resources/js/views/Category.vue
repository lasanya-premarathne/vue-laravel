<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import CategoryTable from "../components/category/CategoryTable.vue";
import CategoryForm from "../components/category/CategoryForm.vue";
import CommonModal from "../components/common-components/CommonModal.vue";

const categories = ref([]);
const selectedCategory = ref(null);
const isModalOpen = ref(false);

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
    isModalOpen.value = false;
    fetchCategories();
};

const handleEditCategory = (category) => {
    selectedCategory.value = category;
    isModalOpen.value = true;
};

const handleAddNew = () => {
    // Reset selected category to null for a new entry
    selectedCategory.value = null;
    // Open the modal
    isModalOpen.value = true;
};
</script>

<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Category View</h1>
            <button class="btn btn-primary" @click="handleAddNew">
                Add New Category
            </button>
        </div>

        <CategoryTable
            :categories="categories"
            @refresh="fetchCategories"
            @edit-category="handleEditCategory"
        />

        <CommonModal
            :isOpen="isModalOpen"
            :title="selectedCategory ? 'Edit Category' : 'Add New Category'"
            @close="isModalOpen = false"
        >
            <CategoryForm
                :category="selectedCategory"
                @category-saved="handleCategorySaved"
            />
        </CommonModal>
    </div>
</template>
