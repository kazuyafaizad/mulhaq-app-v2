<template>
    <AppLayout>
        <div class="flex flex-col items-end md:flex-row md:justify-between md:items-center mb-8">
            <h2 class="text-2xl font-normal text-gray-600">My landing pages</h2>
            <Link :href="route('landing-pages.create')" class="btn btn-primary">
                New landing page
            </Link>
        </div>

        <!-- <div class="grid grid-cols-12 gap-4 p-4 md:p-0">
            <div v-for="landingPage in store.state.landingPages" :key="landingPage.uuid" class="col-span-12 md:col-span-4 lg:col-span-3">
                <LandingPageCard :landingPage="landingPage"/>
            </div>
        </div> -->
    </AppLayout>
</template>

<script>
    import { defineComponent, onMounted } from 'vue'

    import AppLayout from '@/Layouts/Authenticated.vue'
    // import LandingPageCard from './Components/LandingPageCard.vue'

    import { Link } from "@inertiajs/inertia-vue3";

    export default defineComponent({
        name: 'Dashboard',
        components: {
            AppLayout,
            // LandingPageCard,
            Link
        },
    })
</script>
