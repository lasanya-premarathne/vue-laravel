<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import ProductForm from "../components/product/ProductForm.vue";
import ProductTable from "../components/product/ProductTable.vue";

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
    const category = categories.value.find(cat => cat.id === categoryId);
    return category ? category.name : 'Unknown Category';
};

onMounted(fetchProducts);
onMounted(fetchCategories);

</script>

<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Product View</h1>
            <button class="btn btn-primary" @click="handleAddNew">
                Add New Product
            </button>
        </div>

        <!-- Popup Modal -->
        <Transition name="modal">
            <div v-if="isModalOpen" class="modal-overlay">
                <div class="modal-popup">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{
                                selectedCategory
                                    ? "Edit Category"
                                    : "Add New Category"
                            }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            @click="isModalOpen = false"
                        >
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <ProductForm 
                            :product="selectedProduct"
                            @product-saved="handleProductSaved"
                        />
                    </div>
                </div>
            </div>
        </Transition>

        <ProductTable 
            :products="products"
            :categories="categories"
            @edit="editProduct"
            @delete="deleteProduct"
        />
    </div>
</template>

<style scoped>
.container {
    max-width: 900px;
    margin: auto;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-popup {
    background: white;
    border-radius: 8px;
    padding: 20px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.modal-title {
    margin: 0;
    font-size: 1.25rem;
}

/* Modal transition animations */
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-to,
.modal-leave-from {
    opacity: 1;
}
</style>

