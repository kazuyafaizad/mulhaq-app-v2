<template>
    <div  class="min-h-screen flex flex-col justify-between items-center pt-6 sm:pt-0">
            <TopNav />
            <main class="mt-12 lg:mt-5 mb-12 w-full max-w-4xl mx-auto">
                <slot/>
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
import BellIcon from '@/Components/BellIcon.vue'

export default defineComponent({
    props: {
        title: String,
        canLogin: Boolean,
        canRegister: Boolean,
    },

    components: {
        BottomNav,
        Gear,
        TopNav,
        BellIcon
    },

    data() {
        return {
            showingNavigationDropdown: false,
             animate: false,
               notificationCount: 0,
            notificationData: {}
        };
    },
     mounted(){
      this.animate = true;
        if (this.$page.props.auth.user) {
            this.$echo.private('App.Models.User.' + this.$page.props.auth.user.id)
                .notification((notification) => {
                    this.notificationCount += 1;
                    this.$toast.show(notification.message, {
                        type: 'default',
                        position: 'top'
                    });
                    console.log(notification.message);
                });
        }

        this.notificationCount = this.$page.props.notifications

        // Close all opened toast after 3000ms
        setTimeout(this.$toast.clear, 3000)
  },

    methods: {
        showNotifications() {
            axios.post(this.route('post.notification', { user: this.$page.props.auth.user.id })).then((response) => {
                this.notificationData = response.data
            })
        },
         back() {
        window.history.back();
        },
        logout() {
            this.$inertia.post(route("logout"));
        },
    },
});
</script>
