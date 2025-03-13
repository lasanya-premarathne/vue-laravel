<script setup>
import { ref, defineEmits, watchEffect } from "vue";
import axios from "axios";

const props = defineProps({
    product: Object,
    categories: {
        type: Array,
        required: true,
        default: [],
    },
});

const name = ref("");
const unit_price = ref("");
const description = ref("");
const category_id = ref("");
const emit = defineEmits(["product-saved"]);

watchEffect(() => {
    if (props.product) {
        name.value = props.product.name || "";
        unit_price.value = props.product.unit_price || "";
        description.value = props.product.description || "";
        category_id.value = props.product.category_id || "";
    }
});

const saveProduct = async () => {
    try {
        if (props.product?.id) {
            // Update existing product
            await axios.put(`/api/product/${props.product.id}`, {
                name: name.value,
                unit_price: parseFloat(unit_price.value),
                description: description.value,
                category_id: category_id.value,
            });
        } else {
            // Create new product
            await axios.post("/api/product", {
                name: name.value,
                unit_price: parseFloat(unit_price.value),
                description: description.value,
                category_id: category_id.value,
            });
        }

        // Reset form
        name.value = "";
        unit_price.value = "";
        description.value = "";
        category_id.value = "";

        emit("product-saved"); // Notify parent
    } catch (error) {
        console.error("Error saving product:", error);
    }
};
</script>

<template>
    <form @submit.prevent="saveProduct" class="mb-4">
        <div class="mb-3">
            <label class="form-label" for="product-name">Product Name</label>
            <input
                v-model="name"
                type="text"
                class="form-control"
                id="product-name"
                required
            />
        </div>
        <div class="mb-3">
            <label class="form-label" for="product-price">Unit Price</label>
            <input
                v-model="unit_price"
                type="number"
                step="0.01"
                class="form-control"
                id="product-price"
                required
            />
        </div>
        <div class="mb-3">
            <label class="form-label" for="product-description"
                >Description</label
            >
            <input
                v-model="description"
                type="text"
                class="form-control"
                id="product-description"
            />
        </div>
        <div class="mb-3">
            <label class="form-label" for="product-category">Category</label>
            <select
                v-model="category_id"
                class="form-control"
                id="product-category"
                required
            >
                <option value="">Select a category</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            {{ product?.id ? "Update" : "Add" }} Product
        </button>
    </form>
</template>
