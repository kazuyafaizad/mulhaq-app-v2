<template>
    <BreezeAuthenticatedLayout>
        <div class="grid grid-cols-1 gap-5">
        <ProfileHeader :user="$page.props.auth.user" />

        <!-- Campaign card -->
         <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <h2 class="card-title">Campaign List</h2>
            <i class="bi bi-app"></i>
            <div class="card-actions justify-end">
            <Link class="btn btn-accent" :href="route('campaign.index')">Open Page</Link>
            </div>
        </div>
        </div>

        <!-- Landing Page -->
         <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <h2 class="card-title">Create Landing Page</h2>
            <i class="bi bi-wrench-adjustable"></i>
            <div class="card-actions justify-end">
            <Link class="btn btn-accent" :href="route('create.landing')">Open Page</Link>
            </div>
        </div>
        </div>



         </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { defineComponent } from "vue";
import ProfileHeader from "@/Components/ProfileHeader.vue";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from "@inertiajs/inertia-vue3";


export default defineComponent({
    props: ['user'],
    components: {
        BreezeAuthenticatedLayout,
        ProfileHeader,
        Link
    },
});

</script>
