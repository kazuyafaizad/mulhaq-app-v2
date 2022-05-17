<template>
    <BreezeAuthenticatedLayout>
            <div class="flex item-center justify-center mb-5 relative">
              <!-- Profile Photo -->
            <div class="avatar" v-if="$page.props.auth.user.profile_photo_url">
                <div class="w-full max-w-[12rem] rounded-full">
                    <img :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name"  class="object-cover">
                </div>
            </div>
            </div>

            <ul class="menu bg-base-200 p-2 ">
            <li>
                <Link :href="route('view.profile',[$page.props.auth.user.id])">
                <i class="bi bi-file-person  w-5"></i>
                Personal Detail
                </Link>
            </li>
            <li>
                <Link>
                <i class="bi bi-book w-5"></i>
                Education
                </Link>
            </li>
            <li>
                <Link>
                <i class="bi bi-stars w-5"></i>
                Experiences
                </Link>
            </li>
            </ul>

    </BreezeAuthenticatedLayout>
</template>

<script>
import { defineComponent } from "vue";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeTopNav from '@/Components/TopNav.vue';
import Gear from '@/Components/Gear.vue';
import { Link } from "@inertiajs/inertia-vue3";


export default defineComponent({
    props: ['user'],
    components: {
        BreezeAuthenticatedLayout,
        Link,
        Gear,
        BreezeInputError,
        BreezeTopNav
    },

});

</script>
