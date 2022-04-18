<template>
    <Head title="Profile" />

    <MainLayout>

        <div class="relative py-3 sm:max-w-4xl sm:mx-auto" v-if="$page.props.auth.user.tier > 0">
            <div class="relative p-2 bg-neutral rounded sm:p-10 bg-clip-padding bg-opacity-60 border border-gray-200">
                <form @submit.prevent>
                    <textarea class="form-textarea mt-1 block w-full rounded"
                        ref="postArea"
                        rows="3"
                        v-model="this.createPostForm.content"
                        placeholder="Lorem, ipsum dolor sit amet consectetur adipisicing elit."></textarea>
                    <InputError class="mt-1" :message="$page.props.errors.content" />
                    <InputError class="mt-1" :message="$page.props.errors.image" />

                    <Input v-show="false"
                        @change="onFileSelect"
                        ref="fileInput"
                        id="image" type="file" class="mt-1 block w-full" name="image" />
                    <div class="flex flex-row-reverse mt-2 gap-3">
                        <Button
                            @click="createPost"
                            type="button">
                            Post
                        </Button>
                        <Button type="button"
                            @click="$refs.fileInput.$refs.input.click()"
                            class="btn btn-secondary">
                            Attach Image
                        </Button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card lg:card-side bg-accent relative my-5" v-for="(post) in userPosts.data" :key="post.id">
        <figure><img src="https://api.lorem.space/image/album?w=400&h=400" alt="Album"></figure>
        <div class="card-body">
            <div class="card-actions justify-end">
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
            <!-- <h2 class="card-title">New album is released!</h2> -->
            <p>{{ post.content }}</p>
            <div>
                    <div class="flex flex-row justify-between py-4">
                        <span v-if="post.likes > 0" class="text-sm"><span>{{ post.likes }}</span> Likes</span>
                        <span v-if="post.comment.length > 0" class="text-sm"><span>{{ post.comment.length }}</span> Comments</span>
                    </div>
                    <div class="bg-clip-padding border-t border-b border-gray-200">
                        <div class="grid grid-cols-2 my-3 ">
                                <button
                                    v-if="post.likedByCurrentUser !== null && post.likedByCurrentUser === $page.props.auth.user.id"
                                    type="button"
                                    class="text-blue-600 "
                                    @click="onLikePost(post.id)">Unlike</button>

                                <button v-else type="button" @click="onLikePost(post.id)">Like</button>
                                <button type="button" @click="onDisplayCommentBox(post.id)" class="border-l border-gray-200">Comment</button>
                        </div>
                    </div>
                    <div v-if="displayCommentBox === post.id" class="mt-2 mb-4">
                        <form @submit.prevent>
                            <Input
                                :id="`commentBox${post.id}`"
                                type="text"
                                class="mt-1 block w-full"
                                name="content"
                                v-model="createCommentForm.content"
                                @keyup.enter="createComment(post.id)"
                                autofocus />
                            <InputError class="mt-1" :message="$page.props.errors.content" />
                        </form>
                    </div>
                    <div class="pb-4 overflow-y-auto h-52">
                        <div class="flex my-2" v-for="(comment) in post.comment" :key="comment.id">
                            <div class="flex justify-content items-center">
                                <img src="https://via.placeholder.com/35" class="rounded-full rounded-full mb-auto mt-1" />
                                <div>
                                    <div class="ml-3 text-sm py-2 px-4 rounded rounded-md bg-gray-100">
                                        <p class="mb-0">{{ comment.byProfileName }}</p>
                                        <p>{{ comment.content }}</p>
                                    </div>
                                    <p class="text-xs ml-4 py-2">{{ comment.created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-actions justify-end">
            <button class="btn btn-primary btn-block" @click="goToViewPage(post)">Join</button>
            </div>
        </div>
        </div>
        <div class="relative py-3 sm:max-w-4xl sm:mx-auto">
            <p v-show="showPostLoader" class="bg-white p-4 flex justify-center">Loading more posts...</p>
            <p v-show="showNoMorePosts" class="bg-white p-4 flex justify-center">No more posts to load.</p>
        </div>
    </MainLayout>
</template>
<script>
import MainLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import InputError from '@/Components/InputError.vue'
import Input from '@/Components/Input.vue'
import Image from '@/Components/Image.vue'
import EllipsisIcon from '@/Components/EllipsisIcon.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import { debounce } from 'lodash/function'

export default {

    props: {
        posts: Object
    },

    components: {
        MainLayout,
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

    data() {
        return {
            showPostLoader: false,
            showNoMorePosts: false,
            userPosts: this.posts,
            displayCommentBox: false,
            createPostForm: this.$inertia.form({
                content: '',
                image: null
            }),
            createCommentForm: this.$inertia.form({
                content: ''
            })
        }
    },

    updated() {
        this.userPosts = this.posts
    },

    mounted() {
        window.addEventListener('scroll', debounce(this.loadMorePosts, 100));
    },

    destroyed() {
        window.removeEventListener("scroll", this.loadMorePosts);
    },

    methods: {
        loadMorePosts() {
            let offsetHeight = document.documentElement.offsetHeight,
                scrollTop = document.documentElement.scrollTop;

            let pixelsFromBottom = offsetHeight - scrollTop - window.innerHeight;

            if (pixelsFromBottom < 200)
            {
                if (this.userPosts.next_page_url !== null)
                {
                    this.showPostLoader = true

                    axios.get(this.userPosts.next_page_url).then(response => {
                        this.userPosts = {
                            ...response.data,
                            data: [...this.userPosts.data, ...response.data.data]
                        }
                    }).error(() => {
                        this.showPostLoader = false
                    });
                }
                else
                {
                    this.showPostLoader = false
                    this.showNoMorePosts = true
                }
            }
        },
        onFileSelect() {
            this.createPostForm.image = this.$refs.fileInput.$refs.input.files[0]
        },
        createPost() {
            this.createPostForm.post(this.route('post.store'), {
                onFinish: () => {
                    this.createPostForm.content = ''
                    this.createPostForm.image = null
                }
            })
        },
        onDisplayCommentBox(data) {
            this.displayCommentBox = data
        },
        onLikePost(id) {
            this.$inertia.form().post(this.route('post.like.store', { post: id }), {
                preserveScroll: true
            })
        },
        createComment(id) {
            this.createCommentForm.post(this.route('post.comment.store', { post: id }), {
                preserveScroll: true,
                onFinish: () => {
                    this.displayCommentBox = false
                    this.createCommentForm.content = ''
                }
            })
        },
        goToViewPage(data) {
            window.open(this.route('campaign.view', { post: data.id }), '_self');
        }
    }
}
</script>
