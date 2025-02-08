<script setup>
/* import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'; */
import { useForm, Head, Link } from '@inertiajs/vue3'
import { mdiAccount, mdiAsterisk, mdiLogin } from '@mdi/js'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import FormValidationErrors from '@/Components/FormValidationErrors.vue'
import NotificationBarInCard from '@/Components/NotificationBarInCard.vue'
import BaseLevel from '@/Components/BaseLevel.vue'

const props = defineProps({
    canResetPassword: Boolean,
    status: {
        type: String,
        default: null
    }
})

const form = useForm({
    email: '',
    password: '',
    remember: []
})

const submit = () => {
    form
        .transform(data => ({
            ...data,
            remember: form.remember && form.remember.length ? 'on' : ''
        }))
        .post(route('login.store'), {
            onFinish: () => form.reset('password'),
        })
}
</script>

<template>
    <LayoutGuest>

        <Head title="Login" />

        <SectionFullScreen v-slot="{ cardClass }" bg="purplePink">
            <CardBox :class="cardClass + ' p-6'" is-form @submit.prevent="submit">
                <img class="mx-auto py-10" src="/img/logo.png" alt="" width="250">
                <FormValidationErrors />

                <NotificationBarInCard v-if="status" color="info">
                    {{ status }}
                </NotificationBarInCard>
                <FormField label="Correo electrónico" label-for="Correo electrónico" help="Porfavor introduce tu email">
                    <FormControl v-model="form.email" :icon="mdiAccount" id="Correo electrónico" autocomplete="email"
                        type="email" required />
                </FormField>
                <FormField label="Contraseña" label-for="Contraseña" help="Porfavor introduce tu contraseña">
                    <FormControl v-model="form.password" :icon="mdiAsterisk" type="password" id="password"
                        autocomplete="current-password" required />
                </FormField>

                <div class="md:flex md:space-x-4 mb-5">
                    <FormCheckRadioGroup class="md:w-1/2 max-lg:mb-5" v-model="form.remember" name="remember" :options="{ remember: 'Recordar' }" />
                    <BaseButton class="md:w-1/2" route-name="password.request" color="info" outline
                            label="Olvidaste tu contraseña?" />
                </div>
                <BaseDivider />

                <BaseButtons>
                    <BaseButton class="w-full" type="submit" color="info" label="Iniciar sesion"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing" :icon="mdiLogin" />
                </BaseButtons>
                <!-- <Link
            :href="route('register')"
          >
            Registrarse
          </Link> -->
            </CardBox>
        </SectionFullScreen>
    </LayoutGuest>
</template>
