<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Checkbox from 'primevue/checkbox';
import Button from 'primevue/button';
import Message from 'primevue/message';

defineProps({
    canResetPassword: { type: Boolean },
    status: { type: String },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <Message v-if="status" severity="success" class="mb-4">{{ status }}</Message>

        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <label for="email" class="font-semibold text-gray-700">Email</label>
                <InputText id="email" type="email" v-model="form.email" :invalid="!!form.errors.email" required autofocus autocomplete="username" />
                <small v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</small>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="font-semibold text-gray-700">Password</label>
                <InputText id="password" type="password" v-model="form.password" :invalid="!!form.errors.password" required autocomplete="current-password" />
                <small v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</small>
            </div>

            <div class="flex items-center gap-2 mt-2">
                <Checkbox id="remember" v-model="form.remember" :binary="true" />
                <label for="remember" class="text-sm text-gray-600 cursor-pointer">Remember me</label>
            </div>

            <div class="flex items-center justify-end gap-4 mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 hover:text-gray-900 hover:underline">
                    Forgot your password?
                </Link>
                <Button type="submit" label="Log in" :loading="form.processing" />
            </div>

            <!-- Added Registration Link -->
            <div class="pt-4 mt-2 text-center border-t border-gray-200">
                <span class="text-sm text-gray-600">Don't have an account? </span>
                <Link :href="route('register')" class="text-sm font-semibold text-gray-900 hover:underline">
                    Register here
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>