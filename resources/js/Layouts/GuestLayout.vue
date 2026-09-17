<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
</script>

<template>
    <div class="flex flex-col min-h-screen bg-gray-100">
        <!-- Top Navigation Bar -->
        <nav class="flex items-center justify-between px-4 py-4 bg-white border-b border-gray-200 sm:px-6 lg:px-8">
            <Link href="/" class="flex items-center">
                <ApplicationLogo class="w-auto h-9 text-gray-500 fill-current" />
            </Link>

            <div class="flex items-center gap-2">
                <!-- Hide Login button if we are already on the Login page -->
                <Link v-if="!route().current('login')" :href="route('login')">
                    <Button label="Log in" text severity="secondary" />
                </Link>
                
                <!-- Hide Register button if we are already on the Register page -->
                <Link v-if="!route().current('register')" :href="route('register')">
                    <Button label="Register" />
                </Link>
            </div>
        </nav>

        <!-- Centered Form Container -->
        <main class="flex flex-col items-center flex-1 pt-6 sm:justify-center sm:pt-0">
            <div class="w-full px-6 py-8 mt-6 overflow-hidden bg-white shadow-md sm:max-w-4xl sm:rounded-lg">
                <slot />
            </div>
        </main>
    </div>
</template>