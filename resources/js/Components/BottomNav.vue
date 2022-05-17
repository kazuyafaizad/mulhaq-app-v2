<template>
 <div class="tabs flex items-center bg-base-300 w-full justify-center h-20 z-10 fixed bottom-0" v-if="$page.props.auth.user">
      <BreezeNavLink label="Home" :href="route('home')" :active="route().current('home')">
      <div class="flex flex-col justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house w-7 h-7" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg>
                <span class="text-xs  font-medium">Home</span>
                </div>
      </BreezeNavLink>

      <BreezeNavLink label="Page" :href="route('page.index')" :active="route().current('page.*')" >
      <div class="flex flex-col justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task w-7 h-7" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                </svg>
                <span class="text-xs  font-medium">Page</span>
                </div>
      </BreezeNavLink>


      <BreezeNavLink label="Profile"  :href="route('profile')"  :active="route().current('profile')">
      <div class="flex flex-col justify-center items-center">
          <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-person-fill w-7 h-7" viewBox="0 0 20 20">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>

         <span class="text-xs  font-medium">Profile</span>
      </div>
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
