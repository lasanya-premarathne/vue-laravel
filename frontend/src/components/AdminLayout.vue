<template>
    <div>
        <!-- Sidebar -->
        <aside>
            <h2>Admin Sidebar</h2>
        </aside>
    
        <!-- Main Content -->
        <main>
            <slot>
                
            </slot>
        </main>
    </div>
</template>
  
<script>
    export default {
        name: "AdminLayout",
    };
</script>

<style scoped>
    /* You can move styles from the admin template's CSS */
</style>
  