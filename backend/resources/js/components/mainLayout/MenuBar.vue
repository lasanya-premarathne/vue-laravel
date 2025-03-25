<script setup>
defineProps({
    menuItems: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="quixnav">
        <div class="quixnav-scroll">
            <ul class="metismenu" id="menu">
                <li v-for="item in menuItems" :key="item.path">
                    <router-link :to="item.path" class="nav-text">
                        {{ item.label }}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
/* .menu-bar {
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
} */
</style>
