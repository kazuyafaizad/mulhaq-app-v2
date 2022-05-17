<template>
<div class="navbar bg-base-100 fixed top-0 z-20">
  <div class="flex-1">
        <BackButton/>
  </div>
  <div class="flex-none">
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
        <span class="badge badge-xs badge-primary indicator-item"></span>
      </div>
      </label>

      <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
        <div class="card-body">
          <span class="font-bold text-lg">8 Items</span>
          <span class="text-info">Subtotal: $999</span>
          <div class="card-actions">
            <button class="btn btn-primary btn-block">View cart</button>
          </div>
        </div>
      </div>
    </div>
    <div class="dropdown dropdown-end" v-if="$page.props.auth.user">
      <label tabindex="0" class="btn btn-ghost avatar">
         {{ $page.props.auth.user.name }}
      </label>
      <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
       <BreezeDropdownLink :href="route('view.profile', $page.props.auth.user.id)">
                                            Profile
                                        </BreezeDropdownLink>
        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
      </ul>
    </div>

    <div class="dropdown dropdown-end" v-else>
                                    <div class="flex flex-row gap-3">
                                        <BreezeNavLink :href="route('login')">Log in</BreezeNavLink>
                                        <BreezeNavLink :href="route('register')">Register</BreezeNavLink>
                                    </div>
    </div>
  </div>
</div>


</template>

<script>
import { defineComponent,onMounted, onUnmounted, ref  } from "vue";
import { Link,inertia } from "@inertiajs/inertia-vue3";
import BackButton from "@/Components/BackButton.vue";
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'


export default defineComponent({
     props: {

    },
    components: {
        Link,
        BackButton,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
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
