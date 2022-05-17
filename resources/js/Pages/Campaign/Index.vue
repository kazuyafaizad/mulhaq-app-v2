<template>
    <Head title="Profile" />

    <MainLayout>

        <div class="relative py-3 sm:max-w-4xl sm:mx-auto" v-if="$page.props.auth.user.tier > 0">
            <div class="relative p-2 bg-neutral rounded sm:p-10 bg-clip-padding bg-opacity-60 border border-gray-200">
                <form @submit.prevent>
                    <div class="form-control">
                    <Input
                    v-model="this.createPostForm.title"
                    type="text"
                    class="mt-1 mb-3"
                    name="title"
                    placeholder="Title"
                    />
                    <InputError class="mt-1" :message="$page.props.errors.title" />
                    </div>
                    <div class="form-control">
                    <textarea class="textarea"
                        ref="postArea"
                        rows="3"
                        v-model="this.createPostForm.content"
                        placeholder="Lorem, ipsum dolor sit amet consectetur adipisicing elit."></textarea>
                    </div>
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



        <PageCard :post="post" v-for="(post) in userPosts.data" :key="post.id" />
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
import { debounce } from 'lodash/function'
import PageCard from '@/Components/PageCard.vue'

export default {

    props: {
        posts: Object
    },

    components: {
        MainLayout,
        Head,
        Link,
        Button,
        Input,
        InputError,
        PageCard
    },

    data() {
        return {
            showPostLoader: false,
            showNoMorePosts: false,
            userPosts: this.posts,
            displayCommentBox: false,
            createPostForm: this.$inertia.form({
                title:'',
                content: '',
                image: null
            }),
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
                    this.createPostForm.title = ''
                    this.createPostForm.content = ''
                    this.createPostForm.image = null
                }
            })
        },
    }
}
</script>
