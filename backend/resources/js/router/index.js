import { createRouter, createWebHistory } from "vue-router";
import MainLayout from "../layouts/MainLayout.vue";
import Dashboard from "../views/Dashboard.vue";
import Category from "../views/Category.vue";
import Product from "../views/Product.vue";
import Order from "../views/Order.vue";

const routes = [
    {
        path: "/",
        component: MainLayout,
        children: [
            {
                path: "",
                name: "dashboard",
                component: Dashboard,
            },
            {
                path: "category",
                name: "category",
                component: Category,
            },
            {
                path: "product",
                name: "product",
                component: Product,
            },
            {
                path: "order",
                name: "order",
                component: Order,
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
