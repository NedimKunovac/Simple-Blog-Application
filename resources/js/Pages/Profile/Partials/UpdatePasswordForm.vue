<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.$el.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.$el.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Password</h2>
            <p class="mt-1 text-sm text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div class="flex flex-col gap-2">
                <label for="current_password" class="font-semibold text-gray-700">Current Password</label>
                <InputText id="current_password" ref="currentPasswordInput" v-model="form.current_password" type="password" autocomplete="current-password" />
                <small v-if="form.errors.current_password" class="text-red-500">{{ form.errors.current_password }}</small>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="font-semibold text-gray-700">New Password</label>
                <InputText id="password" ref="passwordInput" v-model="form.password" type="password" autocomplete="new-password" />
                <small v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</small>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password_confirmation" class="font-semibold text-gray-700">Confirm Password</label>
                <InputText id="password_confirmation" v-model="form.password_confirmation" type="password" autocomplete="new-password" />
                <small v-if="form.errors.password_confirmation" class="text-red-500">{{ form.errors.password_confirmation }}</small>
            </div>

            <div class="flex items-center gap-4">
                <Button type="submit" label="Save" :loading="form.processing" />
                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>