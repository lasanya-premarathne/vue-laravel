<script setup></script>

<template>
    <div id="app">
        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>
