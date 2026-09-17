<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Message from 'primevue/message';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <Message v-if="status" severity="success" class="mb-4">{{ status }}</Message>

        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <label for="email" class="font-semibold text-gray-700">Email</label>
                <InputText 
                    id="email" 
                    type="email" 
                    v-model="form.email" 
                    :invalid="!!form.errors.email" 
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                <small v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</small>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button type="submit" label="Email Password Reset Link" :loading="form.processing" />
            </div>
        </form>
    </GuestLayout>
</template>