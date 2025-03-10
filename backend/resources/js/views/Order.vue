<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import OrderForm from "../components/order/OrderForm.vue";
import OrderTable from "../components/order/OrderTable.vue";
import CommonModal from "../components/common-components/CommonModal.vue";

const orders = ref([]);
const products = ref([]);
const selectedOrder = ref(null);
const isModalOpen = ref(false);

const fetchOrders = async () => {
    try {
        const response = await axios.get("/api/order");
        orders.value = response.data;
    } catch (error) {
        console.error("Error fetching orders:", error);
    }
};

const fetchProducts = async () => {
    try {
        const response = await axios.get("/api/product");
        products.value = response.data;
    } catch (error) {
        console.error("Error fetching products:", error);
    }
};

const editOrder = async (order) => {
    try {
        const response = await axios.get(`/api/order/${order.id}`);
        selectedOrder.value = response.data;
    } catch (error) {
        console.error("Error fetching order details:", error);
    } finally {
        isModalOpen.value = true;
    }
};

const deleteOrder = async (orderId) => {
    if (!confirm("Are you sure you want to delete this order?")) return;

    try {
        await axios.delete(`/api/order/${orderId}`);
        await fetchOrders();
    } catch (error) {
        console.error("Error deleting order:", error);
    }
};

const handleOrderSaved = () => {
    fetchOrders();
    selectedOrder.value = null;
    isModalOpen.value = false;
};

const handleAddNew = () => {
    selectedOrder.value = null;
    isModalOpen.value = true;
};

onMounted(() => {
    fetchOrders();
    fetchProducts();
});
</script>

<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Orders</h1>
            <button class="btn btn-primary" @click="handleAddNew">
                New Order
            </button>
        </div>

        <OrderTable :orders="orders" @edit="editOrder" @delete="deleteOrder" />

        <CommonModal
            :isOpen="isModalOpen"
            :title="selectedOrder ? 'Edit Order' : 'New Order'"
            @close="isModalOpen = false"
        >
            <OrderForm
                :products="products"
                :order="selectedOrder"
                @order-saved="handleOrderSaved"
            />
        </CommonModal>
    </div>
</template>
