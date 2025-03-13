<script setup>
import { defineProps } from "vue";

const props = defineProps({
    columns: {
        type: Array,
        required: true,
    },
    data: {
        type: Array,
        required: true,
    },
    editAction: {
        type: Function,
        required: false,
    },
    deleteAction: {
        type: Function,
        required: false,
    },
});
</script>

<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th v-for="col in columns" :key="col.key">
                        {{ col.label }}
                    </th>
                    <th v-if="editAction || deleteAction">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data" :key="item.id">
                    <td v-for="col in columns" :key="col.key">
                        {{ item[col.key] }}
                    </td>
                    <td v-if="editAction || deleteAction">
                        <button
                            v-if="editAction"
                            @click="editAction(item)"
                            class="btn btn-sm btn-primary me-2"
                        >
                            Edit
                        </button>
                        <button
                            v-if="deleteAction"
                            @click="deleteAction(item.id)"
                            class="btn btn-sm btn-danger"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
