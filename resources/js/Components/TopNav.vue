<template>
 <div class="left-0 top-0 fixed tabs flex items-center w-full justify-between h-16 lg:px-8">
     <div>
     <BackButton/>
    </div>

     <button class="btn btn-square btn-ghost justify-self-end">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>
</div>

</template>

<script>
import { defineComponent,onMounted, onUnmounted, ref  } from "vue";
import { Link,inertia } from "@inertiajs/inertia-vue3";
import BackButton from "@/Components/BackButton.vue";


export default defineComponent({
     props: {

    },
    components: {
        Link,
        BackButton
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
