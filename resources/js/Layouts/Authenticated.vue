<template>
    <div  class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-3">
        <TopNav />
            <main class="mt-12 lg:mt-5 mb-12 w-full max-w-4xl md:px-6 lg:px-8 pb-5 mx-auto">
                <slot></slot>
            </main>
            <BottomNav/>
    </div>
</template>

<style>
.page-enter-active,
.page-leave-active {
  transition: all .3s;
}

.page-enter,
.page-leave-active {
  opacity: 0;
}
</style>
<script>
import { defineComponent } from "vue";
import TopNav from "@/Components/TopNav.vue";
import BottomNav from "@/Components/BottomNav.vue";
import Gear from "@/Components/Gear.vue";

export default defineComponent({
    props: {
        title: String,
    },

    components: {
        BottomNav,
        Gear,
        TopNav
    },

    data() {
        return {
            showingNavigationDropdown: false,
             animate: false,
        };
    },
     mounted(){
      this.animate = true
  },

    methods: {
         back() {
        window.history.back();
        },
        logout() {
            this.$inertia.post(route("logout"));
        },
    },
});
</script>
