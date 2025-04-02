<script>
import { Link, useForm } from '@inertiajs/vue3';
import { mdiBallotOutline, mdiAccount, mdiMail, mdiPhone, mdiCalendar, mdiIdCard } from "@mdi/js";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseButton from "@/Components/BaseButton.vue";

import { ref, watch, reactive } from 'vue'
import axios from 'axios'
import IconRounded from '@/Components/IconRounded.vue';

import { mdiChevronRight } from '@mdi/js';

export default {
    props: {
        titulo: { type: String, required: true },
        routeName: { type: String, required: true },
        catalog: { type: Object, required: true },
    },
    components: {
        LayoutMain,
        FormField,
        FormControl,
        BaseButton,
    },
    setup() {

        const form = useForm({
            name: '',
            paternalSurname: '',
            maternalSurname: '',
            email: '',
            phone: '',
            age: '',
            birthdate: '',
            ssn: '',
            catalog_ids: [],
            position_interested: [],
            position: '',
            company: '',
            address: '',
            company_phone: '',
            salary: '',
            start_date: '',
            end_date: '',
            termination_reason: '',
            supervisor: '',
            idFront: '',
            idBack: '',
            security: '',
            selfie: '',
            cv: '',
            signature: ''
        });


        const step = ref(1);

        const filePreviews = reactive({
            idFront: null,
            idBack: null,
            security: null,
            selfie: null,
            cv: null,
            signature: null
        });

        const handleFileUpload = (event, field) => {
            const file = event.target.files[0];
            if (file) {
                form[field] = file;
                const reader = new FileReader();
                reader.onload = () => {
                    filePreviews.value[field] = reader.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const emailError = ref(null); // Para almacenar el error de correo
        const isEmailValid = ref(true);

        const nextStep = () => {
            if (step.value < 5) step.value++;
        };

        const prevStep = () => {
            if (step.value > 1) step.value--;
        };

        const handleSubmit = () => {
            form.post(route('entryformat.store'));
        };



        return { form, step, handleFileUpload, nextStep, prevStep, handleSubmit, mdiBallotOutline, mdiAccount, mdiMail, mdiPhone, mdiCalendar, mdiIdCard };
    }
}
</script>

<template>

    <nav class="justify-between px-4 py-3 text-white border rounded-lg sm:flex sm:px-5"
        style="background-color: #031339; border-color: #031339;" aria-label="Breadcrumb">

        <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-2 rtl:space-x-reverse sm:mb-0">

        </ol>

        <div>
            <a :href="route('welcome')">
                <button class="px-16 py-2 text-white bg-red-600 rounded-full hover:bg-red-700 transition">
                    Back
                </button>
            </a>

        </div>

    </nav>



    <!-- Stepper -->
    <div class="grid grid-cols-5 border-b text-center" style="border-color: #031339;">
        <div v-for="(label, index) in ['Personal Info', 'Experience', 'Positions you are interested in', 'Work Info', 'Document']"
            :key="index"
            class="p-4 border-r flex flex-col items-center justify-center relative transition-opacity duration-300"
            :class="{ 'opacity-100': step === index + 1, 'opacity-50': step !== index + 1 }"
            style="border-color: #031339;">

            <!-- Número dentro del círculo -->
            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg relative z-10"
                :class="step === index + 1 ? 'text-white' : 'text-gray-800'" style="background-color: #031339;">
                {{ index + 1 }}
            </div>

            <!-- Etiqueta del paso -->
            <h3 class="text-sm font-semibold mt-2" style="color: #031339;">{{ label }}</h3>
        </div>
    </div>

    <!-- Formulario -->
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
            <form class="p-6 space-y-4" @submit.prevent="handleSubmit">
                <!-- Paso 1: Información Personal -->
                <div v-if="step === 1">
                    <FormField label="First Name">
                        <FormControl v-model="form.name" placeholder="Enter first name" />
                    </FormField>
                    <FormField label="Second Name">
                        <FormControl v-model="form.secondName" placeholder="Enter second name" />
                    </FormField>
                    <FormField label="Last Name">
                        <FormControl v-model="form.lastName" placeholder="Enter last name" />
                    </FormField>

                    <FormField label="Email">
                        <FormControl v-model="form.email" type="email" placeholder="Enter email" />
                    </FormField>

                    <FormField label="Phone Number">
                        <FormControl v-model="form.phone" placeholder="Enter phone number" maxlength="10"
                            @input="form.phone = form.phone.replace(/\D/g, '').slice(0, 10)" />
                    </FormField>
                    <FormField label="Age">
                        <FormControl v-model="form.age" placeholder="Enter age" maxlength="2"
                            @input="form.age = form.age.replace(/\D/g, '').slice(0, 2)" />
                    </FormField>
                    <FormField label="Birthdate">
                        <FormControl v-model="form.birthdate" type="date" />
                    </FormField>
                    <FormField label="Social Security Number (SSN)">
                        <FormControl v-model="form.ssn" placeholder="Enter your social security" maxlength="9"
                            @input="form.ssn = form.ssn.replace(/\D/g, '').slice(0, 9)" />
                    </FormField>
                </div>

                <!-- Paso 2: Contacto -->
                <div v-if="step === 2">
                    <FormField label="Positions you have experience or skill at:">
                        <div class="space-y-2">
                            <div v-for="item in catalog" :key="item.id" class="flex items-center space-x-2">
                                <input type="checkbox" :value="item.id" v-model="form.catalog_ids"
                                    class="form-checkbox h-5 w-5 text-blue-600">
                                <label class="text-gray-700">{{ item.name }}</label>
                            </div>
                        </div>
                    </FormField>
                </div>

                <!-- Paso 3: Dirección -->
                <div v-if="step === 3">
                    <FormField label="Positions you're interested in">
                        <div class="grid grid-cols-2 gap-2">
                            <div v-for="item in catalog" :key="item.id" class="relative">
                                <input type="checkbox" :value="item.id" v-model="form.position_interested"
                                    class="hidden peer" :id="'checkbox-' + item.id" />
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
                <div v-if="step === 4">

                    <FormField label="Position">
                        <FormControl v-model="form.position" placeholder="Enter your position in your previous job" />
                    </FormField>
                    <FormField label="Company">
                        <FormControl v-model="form.company" placeholder="Enter the company name" />
                    </FormField>
                    <FormField label="Supervisor">
                        <FormControl v-model="form.supervisor" placeholder="Enter the supervisor name" />
                    </FormField>
                    <FormField label="Address">
                        <FormControl v-model="form.address" placeholder="Enter the company address" />
                    </FormField>
                    <FormField label="Company Phone">
                        <FormControl v-model="form.company_phone" placeholder="Enter the company phone" />
                    </FormField>
                    <FormField label="Salary">
                        <FormControl v-model="form.salary" placeholder="Enter your previous salary" />
                    </FormField>
                    <FormField label="Enter the date you started">
                        <FormControl v-model="form.start_date" type="date" />
                    </FormField>
                    <FormField label="Enter the date you finished">
                        <FormControl v-model="form.end_date" type="date" />
                    </FormField>
                    <FormField label="Termination Reason">
                        <textarea v-model="form.termination_reason" class="form-control w-full" rows="4"
                            placeholder="Termination reason"></textarea>
                    </FormField>
                </div>

                <div v-if="step === 5">
                    <h2 class="text-xl font-bold mb-4">Document</h2>


                    <FormField label="Front of ID" help="Select a photo of the front of your ID">
                        <FormControl id="photo" type="file" height="h-10.5"
                            @input="form.idFront = $event.target.files[0]" />
                    </FormField>

                    <!-- <FormField label="Back of ID" help="Select a photo from the back of your ID">
                        <FormControl id="photo" type="file" height="h-10.5"
                            @input="form.idBack = $event.target.files[0]" />
                    </FormField>

                    <FormField label="Social security" help="Select a photo of your social security number">
                        <FormControl id="photo" type="file" height="h-10.5"
                            @input="form.idBack = $event.target.files[0]" />
                    </FormField>

                    <FormField label="Selfie" help="Select a photo from the back of your ID">
                        <FormControl id="photo" type="file" height="h-10.5"
                            @input="form.idBack = $event.target.files[0]" />
                           
                    </FormField>

                    <FormField label="CV" help="Select a file of your CV">
                        <FormControl id="photo" type="file" height="h-10.5"
                            @input="form.cv = $event.target.files[0]" />
                    </FormField>
                    <FormField label="Social security" help="Select a photo of your social security number">
                        <FormControl id="photo" type="file" height="h-10.5"
                            @input="form.security = $event.target.files[0]" />
                    </FormField>

                    <FormField label="Signature" help="Select a photo of your signature">
                        <FormControl id="photo" type="file" height="h-10.5"
                            @input="form.cv = $event.target.files[0]" />
                    </FormField> -->

                 
                </div>


                <!-- Botones -->
                <div class="flex justify-between">
                    <BaseButton v-if="step > 1" @click="prevStep"
                        roundedFull="true"   color="whiteDark" label="Back" />

                    <BaseButton v-if="step < 5" @click="nextStep"
                    roundedFull="true"  color="contrast" label="Next" />

                    <BaseButton v-if="step === 5" @click="handleSubmit"
                        class="bg-[#000000] hover:bg-[#374151] text-white px-4 py-2 rounded-md" label="Submit" />

                </div>
            </form>
        </div>
    </div>

</template>
