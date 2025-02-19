<script>
import { Link, useForm } from '@inertiajs/vue3';
import { mdiBallotOutline, mdiAccount, mdiMail, mdiPhone, mdiCalendar, mdiIdCard } from "@mdi/js";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";

export default {
    props: {
        titulo: { type: String, required: true },
        routeName: { type: String, required: true },
        catalog: {
        type: Object,
        required: true,
    },
    },
    components: {
        LayoutMain,
        FormField,
        FormControl,
        BaseDivider,
        BaseButton,
        BaseButtons,
        CardBox,
        SectionTitleLineWithButton
    },
    setup() {
        const handleSubmit = () => {
            form.post(route('entryformat.store'));
        };

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
            company:'',
            address: '',
            company_phone:'',
            salary:'',
            start_date:'',
            end_date:'',
            termination_reason:'',
            supervisor:''

        });

        return { handleSubmit, form, mdiBallotOutline, mdiAccount, mdiMail, mdiPhone, mdiCalendar, mdiIdCard };
    }
}
</script>

<template>
    
        <SectionTitleLineWithButton :icon="mdiBallotOutline" :title="titulo" main>
            <a :href="`${route(routeName + 'index')}`">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </a>
        </SectionTitleLineWithButton>

        <CardBox form class="p-6 space-y-4 bg-white shadow-md rounded-lg" @submit.prevent="handleSubmit">
            <FormField label="First Name">
                <FormControl v-model="form.name" placeholder="Enter first name" />
            </FormField>
            <FormField label="Paternal Surname">
                <FormControl v-model="form.paternalSurname" placeholder="Enter paternal surname" />
            </FormField>
            <FormField label="Maternal Surname">
                <FormControl v-model="form.maternalSurname" placeholder="Enter maternal surname" />
            </FormField>
            <FormField label="Email">
                <FormControl v-model="form.email" type="email" placeholder="Enter email" />
            </FormField>
            <FormField label="Phone Number">
                <FormControl v-model="form.phone"  placeholder="Enter phone number" />
            </FormField>
            <FormField label="Age">
                <FormControl v-model="form.age"  placeholder="Enter age" />
            </FormField>
            <FormField label="Birthdate">
                <FormControl v-model="form.birthdate" type="date" />
            </FormField>
            <FormField label="Social Security Number (SSN)">
                <FormControl v-model="form.ssn" placeholder="Enter SSN" />
            </FormField>
            <FormField label="Positions you have experience or skill at:">
                <div class="space-y-2">
                    <div v-for="item in catalog" :key="item.id" class="flex items-center space-x-2">
                        <input type="checkbox" :value="item.id" v-model="form.catalog_ids" class="form-checkbox h-5 w-5 text-blue-600">
                        <label class="text-gray-700">{{ item.name}}</label>
                    </div>
                </div>
            </FormField>

            
            <FormField label="Positions you're interested in">
    <div class="grid grid-cols-2 gap-2"> <!-- Muestra las opciones en columnas -->
        <div v-for="item in catalog" :key="item.id" class="relative">
            <input 
                type="checkbox" 
                :value="item.id" 
                v-model="form.position_interested" 
                class="hidden peer" 
                :id="'checkbox-' + item.id"
            />
            <label 
                :for="'checkbox-' + item.id"
                class="flex items-center justify-center w-full px-4 py-2 border rounded-lg cursor-pointer 
                       bg-gray-100 text-gray-700 hover:bg-gray-200 
                       peer-checked:bg-gray-600 peer-checked:text-white"
            >
                {{ item.name }}
            </label>
        </div>
    </div>
</FormField>

            <FormField label="Position">
                <FormControl v-model="form.position" placeholder="Position" />
            </FormField>
            
            <FormField label="Company">
                <FormControl v-model="form.company" placeholder="Company" />
            </FormField>
            <FormField label="Supervisor">
                <FormControl v-model="form.supervisor" placeholder="Supervisor" />
            </FormField>

            <FormField label="Address">
                <FormControl v-model="form.address" placeholder="Address" />
            </FormField>
            <FormField label="Company phone">
                <FormControl v-model="form.company_phone" placeholder="Company phone" />
            </FormField>
            <FormField label="Salary">
                <FormControl v-model="form.salary"  placeholder="Salary" />
            </FormField>
            <FormField label="Start date">
                <FormControl v-model="form.start_date"  type="date" />
            </FormField>
            <FormField label="End date">
                <FormControl v-model="form.end_date" type="date" />
            </FormField>
            <FormField label="Termination reason">
                <textarea v-model="form.termination_reason" class="form-control" rows="4" style="width: 100%;" placeholder="Termination reason"></textarea>
            </FormField>


            <!-- Necesito que aqui lo pongas la lista de catalogos con una casilla para poder seleccionar -->
            <template #footer>
                <BaseButtons class="flex justify-end">
                    <BaseButton @click="handleSubmit" type="submit" color="info" label="Create" />
                    <BaseButton :href="route(`${routeName}index`)" type="reset" color="danger" outline
                        label="Cancel" />
                </BaseButtons>
            </template>
        </CardBox>
    
</template>
