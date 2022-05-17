<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<style scoped>
.background {
  background: #fff url("/img/splash.jpg") no-repeat right top;
  background-size: cover;
}
</style>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-1 background">
            <Link href="/">
                <BreezeApplicationLogo class="text-7xl fill-current" />
            </Link>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg bg-base-200 rounded-xl">
            <slot />
        </div>
    </div>
</template>
