<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.$el.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.$el.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>
            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </p>
        </header>

        <Button label="Delete Account" severity="danger" @click="confirmUserDeletion" />

        <Dialog v-model:visible="confirmingUserDeletion" modal header="Are you sure you want to delete your account?" :style="{ width: '40rem' }" @hide="closeModal">
            <p class="text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="flex flex-col gap-2 mt-4">
                <label for="password" class="sr-only">Password</label>
                <InputText
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    @keyup.enter="deleteUser"
                    class="w-full sm:w-3/4"
                />
                <small v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</small>
            </div>

            <template #footer>
                <Button label="Cancel" severity="secondary" text @click="closeModal" />
                <Button label="Delete Account" severity="danger" :loading="form.processing" @click="deleteUser" />
            </template>
        </Dialog>
    </section>
</template>