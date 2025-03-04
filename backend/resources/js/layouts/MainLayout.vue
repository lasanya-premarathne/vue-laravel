<script setup>
import { ref } from "vue";
import Header from "@/components/mainLayout/Header.vue";
import MenuBar from "@/components/mainLayout/MenuBar.vue";
import Footer from "@/components/mainLayout/Footer.vue";

const menuItems = ref([
    { label: "Dashboard", path: "/" },
    { label: "Categories", path: "/category" },
    { label: "Products", path: "/product" },
    { label: "Orders", path: "/order" },
]);
</script>

<template>
    <div class="layout-wrapper">
        <Header />
        <div class="content-wrapper">
            <MenuBar :menuItems="menuItems" />
            <main class="main-content">
                <router-view></router-view>
            </main>
        </div>
        <Footer />
    </div>
</template>

<style scoped>
.layout-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.content-wrapper {
    display: flex;
    flex: 1;
}

.main-content {
    flex: 1;
    padding: 2rem;
}
</style>
