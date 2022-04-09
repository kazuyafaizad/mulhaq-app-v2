<template>
 <div class="left-0 top-0 fixed tabs flex items-center w-full justify-between h-16">
      <BreezeNavLink label="Back" @click="clicked" :href="back">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                <span>Back</span>
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
    data(){
            return {
                back: '',
            }
        },

        clicked(){
                        this.back = window.history.back()
                    },
});
</script>
