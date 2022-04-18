<template>
 <div class="tabs flex items-center w-full justify-between h-16 lg:px-8 z-10  fixed top-0">
     <div>
     <BackButton/>
    </div>
        <div class=" justify-self-end">
                                <BreezeDropdown v-if="$page.props.auth.user" align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}
                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('view.profile', $page.props.auth.user.id)">
                                            Profile
                                        </BreezeDropdownLink>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>

                                <template v-else>
                                    <div class="flex flex-row gap-3">
                                        <BreezeNavLink :href="route('login')">Log in</BreezeNavLink>
                                        <BreezeNavLink :href="route('register')">Register</BreezeNavLink>
                                    </div>
                                </template>
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
