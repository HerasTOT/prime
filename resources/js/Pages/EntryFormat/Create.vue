<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    mdiBallotOutline,
    mdiAccount,
    mdiMail,
    mdiPhone,
    mdiCalendar,
    mdiIdCard,
    mdiArrowLeftThick,
    mdiArrowRightThick,
    mdiContentSaveCheck,
    mdiInformation
} from "@mdi/js";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseButton from "@/Components/BaseButton.vue";
import { ref, watch, reactive, provide, inject } from 'vue'
import axios from 'axios'
import IconRounded from '@/Components/IconRounded.vue';
import { mdiChevronRight } from '@mdi/js';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import CardBox from '@/Components/CardBox.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import { error422 } from '@/Hooks/errorsForm';
import PersonalInfo from './Partials/PersonalInfo.vue';
import LaboralInfo from './Partials/LaboralInfo.vue';
import Documents from './Partials/Documents.vue';
import { dataUriToFile } from "@/Hooks/useFile";
import { useSignature } from '@/Hooks/useSignature';
import NotificationBar from '@/Components/NotificationBar.vue';

const props = defineProps({
    titulo: { type: String, required: true },
    routeName: { type: String, required: true },
    jobPositions: { type: Object, required: true },
});

const form = useForm({
    names: null,
    first_surname: null,
    second_surname: null,
    email: null,
    phone: null,
    age: null,
    birthdate: null,
    ssn: null,
    skills: [],
    desires: [],
    position: null,
    company: null,
    supervisor: null,
    address: null,
    company_phone: null,
    salary: null,
    start_date: null,
    end_date: null,
    termination_reason: null,
    idFront: null,
    idBack: null,
    security: null,
    selfie: null,
    cv: null,
    signature: null
});

const step = ref(1);
const signatureInstance = useSignature(); // Solo una instancia

const nextStep = () => {
    if (step.value < 5) step.value++;
};

const prevStep = () => {
    if (step.value > 1) step.value--;
};

const handleSubmit = () => {
    const signaturePad = signatureInstance.signature.value;
    form.transform(data => ({
        ...data,
        signature: dataUriToFile(signaturePad.saveSignature(), "file"),
    })).post(route('entryformat.store'), {
        onError: () => error422(),
        onFinish: () => { },
    });
};
provide('form', form);
provide("useSignature", signatureInstance);
</script>

<template>

    <Head title="Register form" />
    <LayoutWelcome>

        <CardBox class="max-w-7xl mx-auto animate-fade-down animate-once my-2" bg="bg-gray-100">
            <NotificationBar v-if="$page.props.flash.success" color="success" :icon="mdiInformation" :outline="false">
                {{ $page.props.flash.success }}
            </NotificationBar>

            <NotificationBar v-if="$page.props.flash.error" color="danger" :icon="mdiInformation" :outline="false">
                {{ $page.props.flash.error }}
            </NotificationBar>
            <div class="grid grid-cols-5 border-b text-center border border-black">
                <div v-for="(label, index) in ['Personal Info', 'Experience', 'Positions you are interested in', 'Work Info', 'Document']"
                    :key="index"
                    class="p-4 border-r border-black flex flex-col items-center justify-center relative transition-opacity duration-300 gap-2"
                    :class="{ 'opacity-100': step === index + 1, 'opacity-80': step !== index + 1 }">

                    <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg relative z-10"
                        :class="step === index + 1 ? 'text-white' : 'text-gray-800'" style="background-color: #031339;">
                        {{ index + 1 }}
                    </div>
                    <h3 class="text-sm font-semibold mt-2 text-[#031339] hidden sm:block">{{ label }}</h3>
                </div>
            </div>
            <!-- Formulario -->
            <CardBox class="w-full max-w-2xl m-5 mx-auto">
                <form class="p-6 space-y-4" @submit.prevent="handleSubmit">
                    <!-- Paso 1: Información Personal -->
                    <PersonalInfo v-if="step === 1" />

                    <!-- Paso 2: skills -->
                    <div v-if="step === 2">
                        <FormField label="Positions you have experience or skill at:">
                            <div class="space-y-2">
                                <div v-for="item in jobPositions" :key="item.id" class="flex items-center space-x-2">
                                    <input type="checkbox" :value="item.id" :id="item.id" v-model="form.skills"
                                        class="form-checkbox h-5 w-5 text-blue-600">
                                    <label class="text-gray-700" :for="item.id">{{ item.name }}</label>
                                </div>
                            </div>
                        </FormField>
                    </div>

                    <!-- Paso 3: interested -->
                    <div v-if="step === 3">
                        <FormField label="Positions you're interested in">
                            <div class="grid grid-cols-2 gap-2">
                                <div v-for="item in jobPositions" :key="item.id" class="relative">
                                    <input type="checkbox" :value="item.id" v-model="form.desires" class="hidden peer"
                                        :id="'checkbox-' + item.id" />
                                    <label :for="'checkbox-' + item.id" class="flex items-center justify-center  px-4 py-2 border rounded-lg cursor-pointer 
                       bg-gray-100 text-gray-700 hover:bg-gray-200 
                       peer-checked:bg-gray-600 peer-checked:text-white">
                                        {{ item.name }}
                                    </label>
                                </div>
                            </div>
                        </FormField>
                    </div>

                    <!-- Paso 4: Información Laboral -->
                    <LaboralInfo v-if="step === 4" />

                    <!-- Paso 5: Documents -->
                    <Documents v-if="step === 5" />

                    <!-- Botones -->
                    <BaseButtons class="justify-between">
                        <BaseButton :disabled="step == 1" @click="prevStep" roundedFull color="whiteDark" label="Back"
                            :icon="mdiArrowLeftThick" />

                        <BaseButton v-if="step < 5" @click="nextStep" roundedFull color="contrast" label="Next"
                            :icon="mdiArrowRightThick" />

                        <BaseButton v-if="step === 5" @click="handleSubmit" color="success" label="Submit"
                            :icon="mdiContentSaveCheck" roundedFull />
                    </BaseButtons>
                </form>
            </CardBox>
        </CardBox>
    </LayoutWelcome>
</template>
