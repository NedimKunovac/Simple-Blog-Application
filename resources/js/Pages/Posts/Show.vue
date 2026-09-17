<script setup>
import { computed } from 'vue';
import { Head, useForm, Link, usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Card from 'primevue/card';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import Divider from 'primevue/divider';

const props = defineProps({
    post: Object,
});

// Conditionally pick layout based on auth state
const layout = computed(() => usePage().props.auth.user ? AuthenticatedLayout : GuestLayout);
const user = computed(() => usePage().props.auth.user);

const commentForm = useForm({
    comment: '',
});

const submitComment = () => {
    commentForm.post(route('comments.store', props.post.id), {
        preserveScroll: true,
        onSuccess: () => commentForm.reset('comment'),
    });
};

const deleteComment = (commentId) => {
    if (confirm('Are you sure you want to delete this comment?')) {
        router.delete(route('comments.destroy', commentId), {
            preserveScroll: true,
        });
    }
};

const deletePost = (postId) => {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(route('posts.destroy', postId));
    }
};
</script>

<template>
    <component :is="layout">
        <Head :title="post.title" />

        <div class="max-w-3xl px-4 py-8 mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <Link :href="route('posts.index')" class="text-blue-600 hover:underline">
                    &larr; Back to all posts
                </Link>
            </div>

            <!-- The Post -->
            <article class="p-8 mb-8 bg-white rounded-lg shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="mb-2 text-4xl font-bold text-gray-900">{{ post.title }}</h1>
                        <p class="mb-8 text-gray-500">Written by {{ post.user.name }}</p>
                    </div>
                    <div v-if="user && user.id === post.user_id" class="flex gap-2">
                        <Link :href="route('posts.edit', post.id)">
                            <Button label="Edit" severity="secondary" text size="small" icon="pi pi-pencil" />
                        </Link>
                        <Button label="Delete" severity="danger" text size="small" icon="pi pi-trash" @click="deletePost(post.id)" />
                    </div>
                </div>
                <div class="text-lg leading-relaxed text-gray-800 whitespace-pre-wrap">
                    {{ post.content }}
                </div>
            </article>

            <!-- Comments Section -->
            <h3 class="mb-4 text-2xl font-bold">Comments ({{ post.comments.length }})</h3>

            <!-- Comment Form (Authenticated Only) -->
            <Card class="mb-8 shadow-sm bg-gray-50" v-if="user">
                <template #content>
                    <form @submit.prevent="submitComment" class="flex flex-col gap-4">
                        <Textarea 
                            v-model="commentForm.comment" 
                            placeholder="Leave a comment..." 
                            rows="3" 
                            class="w-full"
                            :invalid="commentForm.errors.comment"
                        />
                        <span v-if="commentForm.errors.comment" class="text-sm text-red-500">{{ commentForm.errors.comment }}</span>
                        <div class="flex justify-end">
                            <Button type="submit" label="Post Comment" :loading="commentForm.processing" />
                        </div>
                    </form>
                </template>
            </Card>
            <div v-else class="mb-8 p-4 bg-gray-50 rounded-lg text-sm text-gray-600">
                Please <Link :href="route('login')" class="text-blue-600 underline font-semibold">log in</Link> to share your thoughts.
            </div>

            <!-- Comments List -->
            <div class="flex flex-col gap-4">
                <Card v-for="comment in post.comments" :key="comment.id" class="shadow-sm">
                    <template #content>
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-gray-900">
                                {{ comment.user ? comment.user.name : 'Guest' }}
                            </span>
                            <Button 
                                v-if="user && user.id === comment.user_id"
                                icon="pi pi-trash" 
                                severity="danger" 
                                text 
                                rounded 
                                size="small"
                                aria-label="Delete Comment"
                                @click="deleteComment(comment.id)" 
                            />
                        </div>
                        <p class="text-gray-700">{{ comment.comment }}</p>
                    </template>
                </Card>
                
                <p v-if="!post.comments.length" class="text-gray-500 italic">
                    No comments yet. Be the first to share your thoughts!
                </p>
            </div>
        </div>
    </component>
</template>