<script setup>
import { computed } from 'vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';

defineProps({
    posts: {
        type: Array,
        required: true,
    },
});

// Conditionally pick the layout based on whether a user session exists
const layout = computed(() => usePage().props.auth.user ? AuthenticatedLayout : GuestLayout);
const user = computed(() => usePage().props.auth.user);

const deletePost = (postId) => {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(route('posts.destroy', postId), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <component :is="layout">
        <Head title="All Posts" />

        <div class="max-w-4xl px-4 py-8 mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Blog Posts</h1>
                <Link :href="route('posts.create')">
                    <Button label="Create Post" icon="pi pi-plus" />
                </Link>
            </div>

            <div class="flex flex-col gap-8">
                <Card v-for="post in posts" :key="post.id" class="shadow-sm">
                    <template #title>
                        <h2 class="text-xl font-semibold">{{ post.title }}</h2>
                    </template>
                    <template #subtitle>
                        <span class="text-sm text-gray-500">By {{ post.user.name }}</span>
                    </template>
                    
                    <template #content>
                        <p class="mb-4 text-gray-700 whitespace-pre-wrap">{{ post.content }}</p>
                        
                        <div v-if="post.comments && post.comments.length > 0" class="pt-4 border-t border-gray-100">
                            <div class="flex flex-col gap-2">
                                <div 
                                    v-for="comment in post.comments.slice(0, 1)" 
                                    :key="comment.id" 
                                    class="px-4 py-2 bg-gray-50 rounded-xl"
                                >
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ comment.user ? comment.user.name : 'Guest' }}
                                    </span>
                                    <span class="text-sm text-gray-700 ml-1">{{ comment.comment }}</span>
                                </div>
                            </div>

                            <div v-if="post.comments.length > 1" class="mt-2 ml-2">
                                <Link :href="route('posts.show', post.id)" class="text-sm font-semibold text-gray-500 hover:text-gray-800 hover:underline">
                                    View {{ post.comments.length - 1 }} more comment(s)
                                </Link>
                            </div>
                        </div>
                    </template>
                    
                    <template #footer>
                        <div class="flex items-center justify-between">
                            <div v-if="user && user.id === post.user_id" class="flex gap-2">
                                <Link :href="route('posts.edit', post.id)">
                                    <Button label="Edit" severity="secondary" text size="small" icon="pi pi-pencil" />
                                </Link>
                                <Button label="Delete" severity="danger" text size="small" icon="pi pi-trash" @click="deletePost(post.id)" />
                            </div>
                            <div v-else></div>

                            <Link :href="route('posts.show', post.id)">
                                <Button label="Read Full Post" severity="secondary" outlined size="small" />
                            </Link>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </component>
</template>