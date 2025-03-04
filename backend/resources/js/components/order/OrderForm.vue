<script setup>
import { ref, computed } from 'vue';
import OrderItemRow from './OrderItemRow.vue';

const props = defineProps({
    products: {
        type: Array,
        required: true
    },
    order: {
        type: Object,
        default: null
    }
});

const emit = defineEmits(['order-saved']);

const customerName = ref(props.order?.customerName || '');
const contactNo = ref(props.order?.contactNo || '');
const items = ref(props.order?.items || [{ productId: '', quantity: 1, price: 0, total: 0 }]);

const totalAmount = computed(() => {
    return items.value.reduce((sum, item) => sum + item.total, 0);
});

const addItem = () => {
    items.value.push({ productId: '', quantity: 1, price: 0, total: 0 });
};

const removeItem = (index) => {
    items.value.splice(index, 1);
};

const saveOrder = async () => {
    try {
        const orderData = {
            customerName: customerName.value,
            contactNo: contactNo.value,
            items: items.value,
            totalAmount: totalAmount.value
        };

        const url = props.order 
            ? `/api/orders/${props.order.id}`
            : '/api/orders';
        
        const method = props.order ? 'put' : 'post';
        
        await axios[method](url, orderData);
        emit('order-saved');
    } catch (error) {
        console.error('Error saving order:', error);
    }
};
</script>

<template>
    <form @submit.prevent="saveOrder">
        <div class="mb-3">
            <label class="form-label" for="customer-name">Customer Name</label>
            <input 
                type="text" 
                class="form-control" 
                v-model="customerName"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label" for="customer-number">Contact Number</label>
            <input 
                type="tel" 
                class="form-control" 
                v-model="contactNo"
                required
            >
        </div>

        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Order Items</h5>
                <button 
                    type="button"
                    class="btn btn-sm btn-secondary"
                    @click="addItem"
                >
                    Add Item
                </button>
            </div>

            <div class="row mb-2">
                <div class="col">Product</div>
                <div class="col-2">Quantity</div>
                <div class="col-2">Total</div>
                <div class="col-1"></div>
            </div>

            <OrderItemRow
                v-for="(item, index) in items"
                :key="index"
                :products="products"
                :item="item"
                :index="index"
                @update:item="(newItem) => items[index] = newItem"
                @remove="removeItem"
            />

            <div class="row mt-3">
                <div class="col text-end">
                    <strong>Total Amount: ${{ totalAmount.toFixed(2) }}</strong>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                {{ order ? 'Update' : 'Place' }} Order
            </button>
        </div>
    </form>
</template> 

<style scoped>
.row {
    display: flex;
    align-items: center;
}
</style>