<template>
    <BreezeAuthenticatedLayout>
        <div class="px-3 grid grid-cols-1 gap-5">
        <ProfileHeader :user="$page.props.auth.user" />

        <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <h2 class="card-title">Menu 1</h2>
            <p>We are using cookies for no reason.</p>
            <div class="card-actions justify-end">
            <button class="btn btn-accent">Open menu 1</button>
            </div>
        </div>
        </div>

        <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <h2 class="card-title">Menu 2</h2>
            <p>We are using cookies for no reason.</p>
            <div class="card-actions justify-end">
            <button class="btn btn-accent">Open menu 2</button>
            </div>
        </div>
        </div>

        <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <h2 class="card-title">Menu 3</h2>
            <p>We are using cookies for no reason.</p>
            <div class="card-actions justify-end">
            <button class="btn btn-accent">Open menu 3</button>
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
        Link,
    },
});

</script>
