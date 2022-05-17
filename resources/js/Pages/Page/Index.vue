<template>
    <Head title="Profile" />

    <MainLayout>
        <div class="tabs center">
        <Link class="tab tab-lifted " :class="route().current('page.create') ? 'tab-active' : ''" :href="route('page.create')">My Page</Link>
        <Link class="tab tab-lifted " :class="route().current('page.index') ? 'tab-active' : ''" :href="route('page.index')">Page</Link>
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
