<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';

const form = useForm({
    title: '',
    content: '',
});

const submit = () => {
    form.post(route('posts.store'));
};
</script>

<template>
    <Head title="Create Post" />

    <div class="max-w-2xl px-4 py-8 mx-auto">
        <Card class="shadow-md">
            <template #title>Create a New Post</template>
            <template #content>
                <form @submit.prevent="submit" class="flex flex-col gap-6 mt-4">
                    <!-- Title Input -->
                    <div class="flex flex-col gap-2">
                        <label for="title" class="font-semibold text-gray-700">Title</label>
                        <InputText id="title" v-model="form.title" class="w-full" :invalid="form.errors.title" />
                        <span v-if="form.errors.title" class="text-sm text-red-500">{{ form.errors.title }}</span>
                    </div>

                    <!-- Content Input -->
                    <div class="flex flex-col gap-2">
                        <label for="content" class="font-semibold text-gray-700">Content</label>
                        <Textarea id="content" v-model="form.content" rows="6" class="w-full" :invalid="form.errors.content" />
                        <span v-if="form.errors.content" class="text-sm text-red-500">{{ form.errors.content }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-4 mt-2">
                        <Link :href="route('posts.index')" class="text-gray-500 hover:text-gray-700">Cancel</Link>
                        <Button type="submit" label="Publish Post" :loading="form.processing" />
                    </div>
                </form>
            </template>
        </Card>
    </div>
</template>