<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

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
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden absolute top-0 right-0 px-6 py-4 sm:block w-full h-32"
            style="background-color: #02143a;">
            <div v-if="$page.props.user" class="flex justify-between items-center">
                
                <div class="flex mr-20">
                    <Link :href="route('dashboard')" class="text-2xl font-bold text-gray-500 underline">Inicio</Link>
                </div>
            </div>
            <template v-else>
                <div class="flex justify-between items-center">
                    <div class="">
                       
                    </div>
                    <div class="flex mr-20">
                        <Link :href="route('login')" class="text-2xl font-bold text-gray-500 underline">Login
                        </Link>
                        
                        <Link :href="route('login')" class=" ml-16 text-2xl font-bold text-gray-500 underline" >Format
                        
                        </Link>
                        <!-- <Link v-if="canRegister" :href="route('register')"
                            class="ml-4 text-2xl font-bold text-gray-500 underline">
                        Registrarse</Link> -->
                    </div>
                </div>
            </template>
        </div>

        <div class="w-3/4 mx-auto sm:px-6 lg:px-8 mt-32">
            <div class="p-4">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center mt-10">
                    Conoce nuestros servicios
                </h2>
                

                
            </div>
        </div>
    </div>
</template>

<style></style>