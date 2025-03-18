<script setup>
import "../../public/theme/css/style.css"
import "../../public/theme/scss/main.scss"
</script>

<template>
    <div id="app">
        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>
