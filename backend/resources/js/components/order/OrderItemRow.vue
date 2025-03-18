<script setup>
const props = defineProps({
    products: {
        type: Array,
        required: true
    },
    item: {
        type: Object,
        required: true
    },
    index: {
        type: Number,
        required: true
    }
});

const emit = defineEmits(['update:item', 'remove']);

const updateProduct = (productId) => {
    const product = props.products.find(p => p.id === parseInt(productId));
    emit('update:item', {
        ...props.item,
        productId: parseInt(productId),
        price: product ? product.unit_price : 0,
        total: product ? product.unit_price * props.item.quantity : 0
    });
};

const updateQuantity = (quantity) => {
    emit('update:item', {
        ...props.item,
        quantity: parseInt(quantity),
        total: props.item.price * parseInt(quantity)
    });
};
</script>

<template>
    <div class="row mb-3 align-items-center container-fluid p-0">
        <div class="col">
            <select 
                class="form-select" 
                v-model="item.productId"
                @change="updateProduct($event.target.value)"
            >
                <option value="">Select Product</option>
                <option 
                    v-for="product in products" 
                    :key="product.id" 
                    :value="product.id"
                >
                    {{ product.name }} (${{ product.unit_price }})
                </option>
            </select>
        </div>
        <div class="col-2">
            <input 
                type="number" 
                class="form-control" 
                v-model="item.quantity"
                @input="updateQuantity($event.target.value)"
                min="1"
            >
        </div>
        <div class="col-2">
            <span>${{ item.total.toFixed(2) }}</span>
        </div>
        <div class="col-1">
            <button 
                class="btn-close"
                @click="emit('remove', index)"
            >
                ×
            </button>
        </div>
    </div>
</template> 

<style scoped>
.row {
    padding: 2px;
    display: flex;
    align-items: center;
}

span {
    font-weight: 600;
    font-size: 1.1em;
}
</style>