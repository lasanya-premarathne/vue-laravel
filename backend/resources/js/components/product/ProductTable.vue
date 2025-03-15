<script setup>
import { computed } from "vue";
import CommonTable from "../common-components/CommonTable.vue";

const props = defineProps({
    products: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const emit = defineEmits(["edit", "delete"]);

const getCategoryName = (categoryId) => {
    const category = props.categories.find((cat) => cat.id === categoryId);
    return category ? category.name : "Unknown Category";
};

const productData = computed(() =>
    props.products.map((product) => ({
        id: product.id,
        name: product.name,
        unit_price: product.unit_price,
        description: product.description,
        category_id:product.category_id,
        category_name: getCategoryName(product.category_id),
    }))
);

const columns = [
    { key: "name", label: "Name" },
    { key: "unit_price", label: "Price" },
    { key: "description", label: "Description" },
    { key: "category_name", label: "Category" },
];
</script>

<template>
    <CommonTable
        :columns="columns"
        :data="productData"
        :editAction="(product) => emit('edit', product)"  
        :deleteAction="(product) => emit('delete', product)" 
    />
</template>
