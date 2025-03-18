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
    <!-- <div id="main-wrapper"> -->
        <div class="nav-header">
            <a href="/" class="brand-logo">
                <img class="logo-abbr" src="../../../public/theme/images/logo.png" alt="">
                <img class="logo-compact" src="../../../public/theme/images/logo-text.png" alt="">
                <img class="brand-title" src="../../../public/theme/images/logo-text.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span
                    ><span class="line"></span>
                </div>
            </div>
        </div>

        <Header />

        <MenuBar :menuItems="menuItems" />

        <div class="content-body">
            <div class="container-fluid">
                <main>
                    <router-view :key="$route.fullPath"></router-view>
                </main>
            </div>
        </div>

        <Footer/>
    <!-- </div> -->
</template>

<style scoped>
/* .layout-wrapper {
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
} */
</style>
