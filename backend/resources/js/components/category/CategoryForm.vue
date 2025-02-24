<script setup>
import { ref, defineEmits, watchEffect } from "vue";
import axios from "axios";

const props = defineProps({
    category: Object,
});

const name = ref("");
const description = ref("");
const emit = defineEmits(["category-saved"]);

watchEffect(() => {
    if (props.category) {
        name.value = props.category.name || "";
        description.value = props.category.description || "";
    }
});

const saveCategory = async () => {
    try {
        if (props.category?.id) {
            // Update existing category
            await axios.put(`/api/category/${props.category.id}`, {
                name: name.value,
                description: description.value,
            });
        } else {
            // Create new category
            await axios.post("/api/category", {
                name: name.value,
                description: description.value,
            });
        }

        name.value = "";
        description.value = "";
        emit("category-saved"); // Notify parent
    } catch (error) {
        console.error("Error saving category:", error);
    }
};
</script>

<template>
    <form @submit.prevent="saveCategory" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input v-model="name" type="text" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input v-model="description" type="text" class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">
            {{ category?.id ? "Update" : "Add" }} Category
        </button>
    </form>
</template>
