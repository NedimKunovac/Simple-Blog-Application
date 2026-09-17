<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

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

            <div class="flex flex-col gap-2">
                <label for="password" class="font-semibold text-gray-700">Password</label>
                <InputText 
                    id="password" 
                    type="password" 
                    v-model="form.password" 
                    :invalid="!!form.errors.password" 
                    required 
                    autocomplete="new-password" 
                />
                <small v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</small>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password_confirmation" class="font-semibold text-gray-700">Confirm Password</label>
                <InputText 
                    id="password_confirmation" 
                    type="password" 
                    v-model="form.password_confirmation" 
                    :invalid="!!form.errors.password_confirmation" 
                    required 
                    autocomplete="new-password" 
                />
                <small v-if="form.errors.password_confirmation" class="text-red-500">{{ form.errors.password_confirmation }}</small>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button type="submit" label="Reset Password" :loading="form.processing" />
            </div>
        </form>
    </GuestLayout>
</template>