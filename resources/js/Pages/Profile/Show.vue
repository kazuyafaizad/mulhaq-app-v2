<template>
    <BreezeAuthenticatedLayout>
        <div class="grid grid-cols-3 gap-3">
            <div class="card bg-base-100 shadow-xl image-full">
            <figure><img src="https://api.lorem.space/image/shoes?w=400&h=225" alt="Shoes" /></figure>
            <div class="card-body">
                <h2 class="card-title">{{ $page.props.auth.user.name }}</h2>
                <div class="card-actions justify-end">
                <button class="btn btn-transparent">>>></button>
                </div>
            </div>
            </div>

            <div class="card bg-base-100 shadow-xl image-full">
            <figure><img src="https://api.lorem.space/image/shoes?w=400&h=225" alt="Shoes" /></figure>
            <div class="card-body">
                <h2 class="card-title">Personal Detail</h2>
                <div class="card-actions justify-end">
                <button class="btn btn-transparent">>>></button>
                </div>
            </div>
            </div>

            <div class="card bg-base-100 shadow-xl image-full">
            <figure><img src="https://api.lorem.space/image/shoes?w=400&h=225" alt="Shoes" /></figure>
            <div class="card-body">
                <h2 class="card-title">Education</h2>
                <div class="card-actions justify-end">
                <button class="btn btn-transparent">>>></button>
                </div>
            </div>
            </div>

            <div class="card bg-base-100 shadow-xl image-full">
            <figure><img src="https://api.lorem.space/image/shoes?w=400&h=225" alt="Shoes" /></figure>
            <div class="card-body">
                <h2 class="card-title">Experiences</h2>
                <div class="card-actions justify-end">
                <button class="btn btn-transparent">>>></button>
                </div>
            </div>
            </div>



            </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { defineComponent } from "vue";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from "@inertiajs/inertia-vue3";


export default defineComponent({
    props: ['user'],
    components: {
        BreezeAuthenticatedLayout,
        Link,
    },
});

</script>
