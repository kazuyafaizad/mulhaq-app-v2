<template>
    <BreezeAuthenticatedLayout>
        <div class="grid grid-cols-1 gap-5">
        <ProfileHeader :user="$page.props.auth.user" />

        <div class="hero min-h-screen" style="background-image: url(https://api.lorem.space/image/fashion?w=1000&h=800);" v-show="$page.props.hero.show">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content" >
        <div class="max-w-md">
        <h1 class="mb-5 text-5xl font-bold">{{$page.props.hero.title}}</h1>
        <p class="mb-5">{{$page.props.hero.content}}</p>
        <Link  :href="$page.props.hero.link" class="btn btn-primary">Get Started</Link>
        </div>
    </div>
    </div>
<div class="divider">Quick Menu</div>
<ul class="menu bg-base-100 w-full p-2 rounded-box">
  <li>
     <Link class="text-xl" :href="route('page.index')">
      <i class="bi bi-calendar-week"></i>
        Page
     </Link>
  </li>
</ul>

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
