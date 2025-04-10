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
import { ref, watch, reactive, provide, inject, onMounted } from 'vue'
import axios from 'axios'
import IconRounded from '@/Components/IconRounded.vue';
import { mdiChevronRight } from '@mdi/js';
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import CardBox from '@/Components/CardBox.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import { error422 } from '@/Hooks/useErrorsForm';
import PersonalInfo from './Partials/PersonalInfo.vue';
import LaboralInfo from './Partials/LaboralInfo.vue';
import Documents from './Partials/Documents.vue';
import { dataUriToFile } from "@/Hooks/useFile";
import { useSignature } from '@/Hooks/useSignature';
import NotificationBar from '@/Components/NotificationBar.vue';
import { gradientBgLight } from "@/colors.js";

const props = defineProps({
    titulo: { type: String, required: true },
    routeName: { type: String, required: true },
    jobPositions: { type: Object, required: true },
    countries: { type: Object, required: true },
    languages: { type: Object, required: true },
    levels: { type: Object, required: true },
});

const form = useForm({
    name: null,
    last_name: null,
    middle_name: null,
    mother_last_name: null,
    email: null,
    phone: null,
    age: null,
    birthdate: null,
    ssn: null,
    country_id: null,
    language_id: null,
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
    signature: null,

    languageEntries: [{ id: 1, languageCode: "", proficiencyLevel: "" }],
});

const step = ref(1);
const signatureInstance = useSignature();

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

const nextStep = async () => {
    const isValid = await validateForm();
    if (isValid) {
        step.value++;
        scrollToTop();
    }
};


const prevStep = () => {
    if (step.value > 1) {
        step.value--;
        scrollToTop();
    }
};

const validateForm = async () => {
    form.reset('errors');
    if (step.value < 5) {
        return new Promise((resolve) => {
            form.transform(data => ({
                ...data,
                step: step.value
            })).post(route('entryFormat.validateFields'), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    resolve(true);
                },
                onError: () => {
                    resolve(false);
                },
                onFinish: () => {
                    resolve(false);
                },
            });
        });
    }
    resolve(false);
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
provide('props', props);
provide("useSignature", signatureInstance);

onMounted(() => {
    const scrollToTopButton = document.getElementById("scrollToTop");
    window.onscroll = function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopButton.classList.remove("hidden");
        } else {
            scrollToTopButton.classList.add("hidden");
        }
    };
    scrollToTopButton?.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});
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
                            :icon="mdiContentSaveCheck" :processing="form.processing" roundedFull />
                    </BaseButtons>

                </form>
                <button id="scrollToTop"
                    class="animate-bounce animate-once animate-duration-500 hidden fixed bottom-20 right-10 text-black p-3 rounded-full shadow-lg bg-slate-200 hover:bg-slate-300 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" width="32" height="32"
                        stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor">
                        <path d="M12 5v6m0 3v1.5m0 3v.5"></path>
                        <path d="M16 9l-4 -4"></path>
                        <path d="M8 9l4 -4"></path>
                    </svg>
                </button>
            </CardBox>
        </CardBox>
    </LayoutWelcome>
</template>
