<template>
    <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <h2 class="card-title">{{title}}</h2>
            <i :class="icon"></i>
            <div class="card-actions justify-end">
            <Link class="btn btn-accent" :href="route">Open Page</Link>
            </div>
        </div>
        </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: ['title','icon','route'],
        components: {
            Link,
        },
    })

</script>
