import { createRouter, createWebHistory } from "vue-router";
import MainLayout from "../layouts/MainLayout.vue";
import Dashboard from "../views/Dashboard.vue";
import Category from "../views/Category.vue";
import Product from "../views/Product.vue";

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
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
