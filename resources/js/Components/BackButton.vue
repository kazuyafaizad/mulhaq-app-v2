
<script>

import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import BreezeNavLink from '@/Components/NavLink.vue';

export default {
    components:{
        BreezeNavLink
    },


    setup() {
			let urlPrev = usePage().props.value.urlPrev

			const back = () => {
				if (urlPrev !== 'empty') {
					Inertia.visit(urlPrev)
				}
			}
            const classes = computed(() => urlPrev !== 'empty'
                ? 'flex'
                : 'hidden'
            );



		 	return {
                      back,
                      classes
            }
    }
}
</script>

<template>
    <button label="Back" @click="back" class="flex items-center justify-center btn btn-ghost" :class="classes">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                <span>Back</span>
      </button>
</template>
