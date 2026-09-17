<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-50">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center gap-8">
                            <!-- Logo -->
                            <Link :href="route('posts.index')" class="flex items-center shrink-0">
                                <ApplicationLogo class="block w-auto h-9 fill-current text-gray-800" />
                            </Link>

                            <!-- Navigation Links (Desktop) -->
                            <div class="hidden sm:flex sm:items-center gap-2">
                                <Link :href="route('posts.index')">
                                    <Button label="Posts" text :severity="route().current('posts.index') ? 'info' : 'secondary'" />
                                </Link>
                                <!-- Keep Dashboard link if you still use it -->
                                <Link v-if="route().has('dashboard')" :href="route('dashboard')">
                                    <Button label="Dashboard" text :severity="route().current('dashboard') ? 'info' : 'secondary'" />
                                </Link>
                            </div>
                        </div>

                        <!-- User Actions (Desktop) -->
                        <div class="hidden sm:flex sm:items-center gap-2">
                            <span class="mr-4 text-sm font-medium text-gray-600">
                                Hello, {{ $page.props.auth.user.name }}
                            </span>
                            
                            <Link :href="route('profile.edit')">
                                <Button label="Profile" icon="pi pi-user" severity="secondary" text />
                            </Link>
                            
                            <Link :href="route('logout')" method="post" as="button">
                                <Button label="Log Out" icon="pi pi-sign-out" severity="danger" text />
                            </Link>
                        </div>

                        <!-- Hamburger (Mobile) -->
                        <div class="flex items-center -me-2 sm:hidden">
                            <Button 
                                icon="pi pi-bars" 
                                text 
                                severity="secondary" 
                                @click="showingNavigationDropdown = !showingNavigationDropdown" 
                                aria-label="Toggle Navigation"
                            />
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div v-show="showingNavigationDropdown" class="sm:hidden">
                    <div class="flex flex-col gap-1 px-4 pt-2 pb-3">
                        <Link :href="route('posts.index')">
                            <Button label="Posts" text class="w-full justify-start" />
                        </Link>
                        <Link v-if="route().has('dashboard')" :href="route('dashboard')">
                            <Button label="Dashboard" text class="w-full justify-start" />
                        </Link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-3 border-t border-gray-200">
                        <div class="px-4 mb-3">
                            <div class="text-base font-medium text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 px-4">
                            <Link :href="route('profile.edit')">
                                <Button label="Profile" icon="pi pi-user" text class="w-full justify-start" />
                            </Link>
                            <Link :href="route('logout')" method="post" as="button" class="w-full">
                                <Button label="Log Out" icon="pi pi-sign-out" severity="danger" text class="w-full justify-start" />
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>