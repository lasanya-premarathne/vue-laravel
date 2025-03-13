<script setup>
import { defineProps, defineEmits } from "vue";
import CommonTable from "../common-components/CommonTable.vue";

const props = defineProps({
    orders: {
        type: Array,
        required: true,
    },
});

const emit = defineEmits(["edit", "delete"]);

const columns = [
    { key: "id", label: "Order ID" },
    { key: "customer_name", label: "Customer Name" },
    { key: "contact_number", label: "Contact No" },
    { key: "total", label: "Total Amount" },
];
</script>

<template>
    <CommonTable
        :columns="columns"
        :data="orders"
        :editAction="(order) => emit('edit', order)"
        :deleteAction="(orderId) => emit('delete', orderId)"
    />
</template>
