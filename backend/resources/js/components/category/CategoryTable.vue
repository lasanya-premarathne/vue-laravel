<script setup>
import axios from "axios";
import CommonTable from "../common-components/CommonTable.vue";

const props = defineProps({
    categories: Array,
});

const emit = defineEmits(["refresh", "edit-category"]);

const deleteCategory = async (id) => {
    if (confirm("Are you sure you want to delete this category?")) {
        try {
            await axios.delete(`/api/category/${id}`);
            emit("refresh"); // Reload categories
        } catch (error) {
            console.error("Error deleting category:", error);
        }
    }
};

const editCategory = (category) => {
    emit("edit-category", category); // Pass selected category to parent
};

const columns = [
    { key: "id", label: "ID" },
    { key: "name", label: "Name" },
    { key: "description", label: "Description" },
];
</script>

<template>
    <CommonTable
        :columns="columns"
        :data="categories"
        :editAction="editCategory"
        :deleteAction="deleteCategory"
    />
</template>
