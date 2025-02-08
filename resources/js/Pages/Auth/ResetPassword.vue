<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue'
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import { mdiAccount, mdiAsterisk, mdiLogin, mdiLockReset, mdiLock } from '@mdi/js'

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
    <LayoutGuest>

        <Head title="Reestablecer contraseña" />
        <SectionFullScreen v-slot="{ cardClass }" bg="purplePink">
            <CardBox :class="cardClass + ' p-6'" is-form @submit.prevent="submit">
                <img class="mx-auto py-10" src="/img/logo.png" alt="" width="250">

                <h1 class="my-6 text-2xl font-bold text-center">
                    Reestablecer contraseña
                </h1>

                <FormField required label="Correo electrónico" label-for="Correo electrónico"
                    help="Porfavor introduce tu email" :error="form.errors.email">
                    <FormControl v-model="form.email" :icon="mdiAccount" id="Correo electrónico" autocomplete="email"
                        type="email" required />
                </FormField>

                <FormField required label="Contraseña Nueva:" :error="form.errors.password">
                    <FormControl type="password" v-model="form.password" :icon="mdiLock" placeholder="Contraseña Nueva"
                        required />
                </FormField>

                <FormField required label="Contraseña Confirmación:" :error="form.errors.password_confirmation">
                    <FormControl type="password" v-model="form.password_confirmation" :icon="mdiLock"
                        placeholder="Confirmar contraseña" required />
                </FormField>

                <BaseButtons>
                    <BaseButton :icon="mdiLockReset" class="w-full" color="info" label="Reestablecer"
                        @click="submit" />
                </BaseButtons>
            </CardBox>
        </SectionFullScreen>
    </LayoutGuest>
</template>
