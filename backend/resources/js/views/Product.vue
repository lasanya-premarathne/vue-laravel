<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import ProductForm from "../components/product/ProductForm.vue";
import ProductTable from "../components/product/ProductTable.vue";
import CommonModal from "../components/common-components/CommonModal.vue";

const products = ref([]);
const selectedProduct = ref(null);
const isModalOpen = ref(false);
const categories = ref([]);

const fetchProducts = async () => {
    try {
        const response = await axios.get("/api/product");
        products.value = response.data;
    } catch (error) {
        console.error("Error fetching products:", error);
    }
};

const editProduct = (product) => {
    selectedProduct.value = product;
};

const deleteProduct = async (productId) => {
    if (!confirm("Are you sure you want to delete this product?")) return;

    try {
        await axios.delete(`/api/product/${productId}`);
        await fetchProducts();
    } catch (error) {
        console.error("Error deleting product:", error);
    }
};

const handleProductSaved = () => {
    fetchProducts();
    selectedProduct.value = null;
    isModalOpen.value = false;
};

const handleAddNew = () => {
    // Reset selected category to null for a new entry
    selectedProduct.value = null;
    // Open the modal
    isModalOpen.value = true;
};

const fetchCategories = async () => {
    try {
        const response = await axios.get("/api/category");
        categories.value = response.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

const getCategoryName = (categoryId) => {
    const category = categories.value.find((cat) => cat.id === categoryId);
    return category ? category.name : "Unknown Category";
};

onMounted(fetchProducts);
onMounted(fetchCategories);
</script>

<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Product View</h1>
            <button class="btn btn-primary" @click="handleAddNew">
                Add New Product
            </button>
        </div>

        <CommonModal
            :isOpen="isModalOpen"
            :title="selectedProduct ? 'Edit Product' : 'Add New Product'"
            @close="isModalOpen = false"
        >
            <ProductForm
                :product="selectedProduct"
                @product-saved="handleProductSaved"
            />
        </CommonModal>

        <ProductTable
            :products="products"
            :categories="categories"
            @edit="editProduct"
            @delete="deleteProduct"
        />
    </div>
</template>
