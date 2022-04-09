<template>
 <div class="left-0 bottom-0 lg:hidden fixed tabs flex items-center bg-base-300 w-full justify-center h-16">
      <BreezeNavLink label="Home" :href="route('home')" :active="route().current('home')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house w-7 h-7" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg>
      </BreezeNavLink>
      <BreezeNavLink label="Profile"  :href="route('profile')"  :active="route().current('profile')">
       <div>USERNAME</div>
      </BreezeNavLink>
</div>


<div class="hidden lg:flex top-0 fixed items-center justify-center bg-base-300 w-full">
    <BreezeNavLink label="Home" :href="route('home')" :active="route().current('home')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house w-7 h-7" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg>
      </BreezeNavLink>
      <BreezeNavLink label="Profile"  :href="route('profile')"  :active="route().current('profile')">
       <div>USERNAME</div>
      </BreezeNavLink>
</div>

</template>

<script>
import { defineComponent,onMounted, onUnmounted, ref  } from "vue";
import { Link,inertia } from "@inertiajs/inertia-vue3";
import BreezeNavLink from '@/Components/NavLink.vue';


export default defineComponent({
     props: {

    },
    components: {
        Link,
        BreezeNavLink
    },
    methods: {
        disabled() {
            this.$page.props.message = "Disabled"
        },
        showAlert(message){
             alert(message);
        }

    },
    setup() {
        let open = ref(false)

        const closeOnEscape = (e) => {
            if (open.value && e.key === 'Escape') {
                open.value = false
            }
        }

        onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

        return {
            open,
        }
    },
});
</script>
