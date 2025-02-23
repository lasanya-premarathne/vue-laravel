<script setup>
import { ref } from "vue";

const menuItems = ref([
    { label: "Dashboard", path: "/" },
    { label: "Categories", path: "/category" },
]);
</script>

<template>
    <div class="layout-wrapper">
        <!-- Header -->
        <header class="header">
            <h1>Admin Panel</h1>
        </header>

        <div class="content-wrapper">
            <!-- Menu Bar -->
            <nav class="menu-bar">
                <router-link
                    v-for="item in menuItems"
                    :key="item.path"
                    :to="item.path"
                    class="menu-item"
                >
                    {{ item.label }}
                </router-link>
            </nav>

            <!-- Main Content -->
            <main class="main-content">
                <router-view></router-view>
            </main>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>Footer</p>
        </footer>
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

.header {
    background-color: darkgreen;
    color: white;
    padding: 1rem;
    text-align: center;
}

.menu-bar {
    width: 250px;
    background-color: lightgreen;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.menu-item {
    color: white;
    text-decoration: none;
    padding: 0.8rem 1rem;
    border-radius: 4px;
    transition: background-color 0.2s;
    background-color: green;
}

.menu-item:hover {
    background-color: greenyellow;
}

.menu-item.router-link-active {
    background-color: darkgreen;
}

.main-content {
    flex: 1;
    padding: 2rem;
}

.footer {
    background-color: darkgreen;
    color: white;
    text-align: center;
    padding: 1rem;
}
</style>
