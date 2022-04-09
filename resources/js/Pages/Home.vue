<template>
    <BreezeAuthenticatedLayout>
        <div class="px-3">
        <ProfileHeader :user="$page.props.auth.user" />
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
