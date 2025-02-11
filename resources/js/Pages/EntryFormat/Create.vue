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
            ssn: ''
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
            
            <template #footer>
                <BaseButtons class="flex justify-end">
                    <BaseButton @click="handleSubmit" type="submit" color="info" label="Create" />
                    <BaseButton :href="route(`${routeName}index`)" type="reset" color="danger" outline
                        label="Cancel" />
                </BaseButtons>
            </template>
        </CardBox>
    
</template>
