<template>
        <div
            @click="open = !open"
            class='text-primary focus:text-t-light-blue hover:text-t-light-blue justify-center inline-block text-center pt-2 pb-1 absolute right-5'>
				<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-wide w-8" viewBox="0 0 16 16">
                    <path d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z"/>
                </svg>
		</div>


                <!-- Full Screen Dropdown Overlay -->
            <div v-show="open" class="fixed inset-0 z-40" @click="open = false">
            <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open"
                    class="absolute z-50 mt-2 rounded-md shadow-lg w-1/3"
                    :class="[ alignmentClasses]"
                    style="display: none;"
                    @click="open = false">

                <div class="rounded-md ring-1 ring-black ring-opacity-5" :class="contentClasses">
                    <div>
                          <Link :href="route('profile.edit')" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">Edit Account</Link>
                        <Link :href="route('settings')" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">Settings</Link>
                        <Link :href="route('api-tokens.index')" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition" v-if="$page.props.jetstream.hasApiFeatures">API Token</Link>
                         <div class="border-t border-gray-100"></div>
                          <form @submit.prevent="logout">
                                             <button type="submit" class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                             Log out
                                            </button>
                          </form>
                    </div>
                </div>
            </div>
        </transition>
            </div>
</template>

<script>
import { defineComponent,onMounted, onUnmounted, ref  } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
     props: {
        align: {
            default: 'top'
        },
        width: {
            default: '48'
        },
        contentClasses: {
            default: () => ['py-1', 'bg-white']
        }
    },
    components: {
        Link
    },
    methods: {
        disabled() {
            this.$page.props.message = "Disabled"
        },
        logout() {
            this.$inertia.post(route("logout"));
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

    computed: {
        widthClass() {
            return {
                '48': 'w-48',
            }[this.width.toString()]
        },

        alignmentClasses() {
            if (this.align === 'left') {
                return 'origin-top-left left-0'
            } else if (this.align === 'right') {
                return 'origin-top-right right-0'
            } else if (this.align === 'bottom') {
                return 'origin-bottom-right right-0 bottom-14'
            } else {
                return 'origin-top right-8 top-12'
            }
        },
    }
});
</script>
