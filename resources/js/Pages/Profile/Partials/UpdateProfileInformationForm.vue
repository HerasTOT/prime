<script setup>
import {
    mdiAccount,
    mdiEmail,
    mdiAsterisk,
    mdiFormTextboxPassword,
    mdiGithub,
    mdiPhoneDial,
    mdiOfficeBuilding,
    mdiAccountStar,
    mdiPercentCircle,
    mdiContentSave,
} from "@mdi/js";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import { computed, onMounted, reactive, ref, watch } from "vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import BaseButton from "@/Components/BaseButton.vue";
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import axios from 'axios'

const user = usePage().props.auth.user;

const form = useForm({
    photo: null,
})

const getData = {
    name: user.name,
    email: user.email,
    roles: user.roles.map(role => role.name),
}

const getImage = computed(() => {
    if(form.photo!==null){
        return URL.createObjectURL(form.photo)
    }
    if (user.file) {
        return user.file.path
    }
    return 'img/imageVertical.jpg'
});

const savePhoto = () => {
    // form.post(route('user.updatePhoto', user.id), {
    //     onError: (error) => {
    //         console.log('error: ' + error)
    //     },
    // });
}

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-slate-100">Información personal</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-slate-400">
                Actualice la información del perfil y la dirección de correo electrónico de su cuenta.
            </p>
        </header>
        <form @submit.prevent="saveUser" class="mt-6 space-y-6">
            <div class="md:flex md:space-x-4 mb-5">
                <div class="md:w-1/4 max-lg:mb-5">
                    <img id="photo" :src="getImage" class="rounded w-full h-60 object-cover">
                    <jet-input class="mt-1 w-full border border-slate-800" aria-describedby="file_input_help" id="photo"
                        type="file" @input="form.photo = $event.target.files[0]" />
                    <JetInputError :message="form.errors.photo" />
                </div>
                <div class="md:w-3/4">
                    <FormField label="Nombre completo:">
                        <FormControl :icon="mdiAccount" v-model="getData.name" placeholder="Nombre completo" disabled />
                    </FormField>
                    <FormField label="Correo Electrónico:">
                        <FormControl v-model="getData.email" :icon="mdiEmail" placeholder="Correo Electrónico"
                            disabled />
                    </FormField>
                </div>
            </div>
            <div class="md:flex md:space-x-4">
                <FormField class="w-full" label="Rol en el sistema:">
                    <FormControl :disabled="true" v-model="getData.roles" :icon="mdiAccountStar" />
                </FormField>
            </div>
            <div class="flex items-center gap-4">
                <BaseButton title="Guardar" @click="savePhoto" :icon="mdiContentSave" color="success" label="Guardar foto" />
                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Guardado.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
