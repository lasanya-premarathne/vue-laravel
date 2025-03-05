<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import OrderForm from '../components/order/OrderForm.vue';
import OrderTable from '../components/order/OrderTable.vue';

const orders = ref([]);
const products = ref([]);
const selectedOrder = ref(null);
const isModalOpen = ref(false);

const fetchOrders = async () => {
    try {
        const response = await axios.get('/api/order');
        orders.value = response.data;
    } catch (error) {
        console.error('Error fetching orders:', error);
    }
};

const fetchProducts = async () => {
    try {
        const response = await axios.get('/api/product');
        products.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

const editOrder = (order) => {
    selectedOrder.value = order;
    isModalOpen.value = true;
};

const deleteOrder = async (orderId) => {
    if (!confirm('Are you sure you want to delete this order?')) return;
    
    try {
        await axios.delete(`/api/order/${orderId}`);
        await fetchOrders();
    } catch (error) {
        console.error('Error deleting order:', error);
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
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Orders</h1>
            <button class="btn btn-primary" @click="handleAddNew">
                New Order
            </button>
        </div>

        <OrderTable 
            :orders="orders"
            @edit="editOrder"
            @delete="deleteOrder"
        />

        <!-- Modal -->
        <Transition name="modal">
            <div v-if="isModalOpen" class="modal-overlay">
                <div class="modal-popup">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ selectedOrder ? 'Edit Order' : 'New Order' }}
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
                        <OrderForm 
                            :products="products"
                            :order="selectedOrder"
                            @order-saved="handleOrderSaved"
                        />
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
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
    max-width: 700px;
    max-height: 90vh;
    overflow-y: auto;
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