<script setup>
import ApplicationMark from '@/Components/ApplicationMark.vue';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import NotificationBar from '@/Components/NotificationBar.vue';
import { mdiInformation } from '@mdi/js';
import { Head } from '@inertiajs/vue3';
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    servicios: Object,
});
</script>

<template>
    <Head title="Bienvenido" />
    <LayoutWelcome>
        <!-- Contenido -->
        <section data-aos="fade-down" class="min-h-screen max-w-7xl mx-auto py-10 bg-transparent dark:bg-blue-950">
            <NotificationBar v-if="$page.props.flash.success" color="success" :icon="mdiInformation" :outline="false">
                {{ $page.props.flash.success }}
            </NotificationBar>

            <NotificationBar v-if="$page.props.flash.error" color="danger" :icon="mdiInformation" :outline="false">
                {{ $page.props.flash.error }}
            </NotificationBar>
        </section>
    </LayoutWelcome>
</template>