<script>
import Button from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import InputError from '@/Components/InputError.vue'
import Input from '@/Components/Input.vue'
import Image from '@/Components/Image.vue'
import EllipsisIcon from '@/Components/EllipsisIcon.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import Dropdown from '@/Components/Dropdown.vue'

export default {

    props: {
        post: Object
    },

    components: {
        Dropdown,
        DropdownLink,
        Head,
        Link,
        Button,
        Input,
        InputError,
        Image,
        EllipsisIcon,
    },

    methods: {
        goToViewPage(data) {
            window.open(this.route('view.campaign', { post: data.slug }), '_self');
        }
    }
}
</script>

<template>
    <div class="hero min-h-screen" style="background-image: url(https://api.lorem.space/image/fashion?w=1000&h=800);">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md">
        <h1 class="mb-5 text-5xl font-bold">{{ post.title }}</h1>
        <p class="mb-5">{{ post.content }}</p>
       <button class="btn btn-primary btn-block" @click="goToViewPage(post)">Join</button>
        </div>
        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button type="button" class="mt-2">
                                    <i class="bi bi-share"></i>
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink>
                                <ShareNetwork
                                    network="facebook"
                                    :url="route('view.campaign', { post: post.slug })"
                                    :title="post.content"
                                    :description="post.content"
                                    :quote="post.content"
                                    hashtags="mulhaq,campaign,sukarelawan">
                                    Share on Facebook
                                </ShareNetwork>
                                </DropdownLink>
                                <DropdownLink>
                                <ShareNetwork
                                    network="WhatsApp"
                                    :url="route('view.campaign', { post: post.slug })"
                                    :title="post.content"
                                    :description="post.content"
                                    :quote="post.content"
                                    hashtags="mulhaq,campaign,sukarelawan">
                                    Share on WhatsApp
                                </ShareNetwork>
                                </DropdownLink>

                </template>
                        </Dropdown>
                        <Dropdown v-if="post.user_id === $page.props.auth.user.id" align="right" width="48">
                            <template #trigger>
                                <button type="button" class="mt-2">
                                    <EllipsisIcon />
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('post.visibility', { post: post.id, visibility: 'public' })" method="post" as="button" preserve-scroll>
                                    Set to Public
                                </DropdownLink>
                                <DropdownLink :href="route('post.visibility', { post: post.id, visibility: 'private' })" method="post" as="button" preserve-scroll>
                                    Set to Private
                                </DropdownLink>
                            </template>
                        </Dropdown>
    </div>
    </div>
</template>
