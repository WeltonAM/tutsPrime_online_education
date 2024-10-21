<script setup>
    import Navbar from "./components/Navbar.vue";
    import Footer from "./components/Footer.vue";
</script>

<template>
    <div class="d-flex flex-column min-vh-100 justify-content-between">
        <Navbar />
        
        <div class="flex-1">
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </div>
        
        <Footer />
    </div>
</template>

<style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
</style>
