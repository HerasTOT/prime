<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import FormField from '@/Components/FormField.vue';
import FormControl from '@/Components/FormControl.vue';
import { mdiAccount, mdiAsterisk, mdiLogin, mdiEmailArrowRight } from '@mdi/js'
import BaseButton from '@/Components/BaseButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue';

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
    <LayoutGuest>

        <Head title="Recuperar contraseña" />
        <SectionFullScreen v-slot="{ cardClass }" bg="purplePink">
            <CardBox :class="cardClass + ' p-6'" is-form @submit.prevent="submit">
                <img class="mx-auto py-10" src="/img/logo.png" alt="" width="250">

                <h1 class="my-6 text-2xl font-bold text-center">
                    Recuperar contraseña
                </h1>
                <div class="mb-4 text-sm text-gray-600">
                    Ingresa el correo electrónico que registraste para enviarte un enlace que te permitirá restablecer tu contraseña.
                </div>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <FormField required label="Correo electrónico" label-for="Correo electrónico"
                    help="Porfavor introduce tu email" :error="form.errors.email">
                    <FormControl v-model="form.email" :icon="mdiAccount" id="Correo electrónico" autocomplete="email"
                        type="email" required />
                </FormField>

                <BaseButtons>
                    <BaseButton :icon="mdiEmailArrowRight" class="w-full" color="info" label="Enviar correo"
                        @click="submit" />
                </BaseButtons>
            </CardBox>
        </SectionFullScreen>
    </LayoutGuest>
</template>
