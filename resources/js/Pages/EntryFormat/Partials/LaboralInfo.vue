<script setup>
import FormControl from '@/Components/FormControl.vue';
import FormField from '@/Components/FormField.vue';
import { inject } from 'vue';
import { mdiCurrencyUsd } from '@mdi/js';
import InputMask from 'primevue/inputmask';

const form = inject('form');

</script>

<template>
    <FormField label="Position" required :error="form.errors.position">
        <FormControl v-model="form.position" placeholder="Enter your position in your previous job" />
    </FormField>
    <FormField label="Company" required :error="form.errors.company">
        <FormControl v-model="form.company" placeholder="Enter the company name" />
    </FormField>
    <FormField label="Supervisor" required :error="form.errors.supervisor">
        <FormControl v-model="form.supervisor" placeholder="Enter the supervisor name" />
    </FormField>
    <FormField label="Address" :error="form.errors.address">
        <FormControl v-model="form.address" placeholder="Enter the company address" />
    </FormField>
    <FormField label="Company Phone" :error="form.errors.company_phone">
        <FormControl v-model="form.company_phone" mask="(999) 999-9999" placeholder="(000) 000-0000" type="mask"
            fluid />
    </FormField>
    <FormField label="Salary" required :error="form.errors.salary">
        <FormControl v-model="form.salary" :icon="mdiCurrencyUsd" placeholder="_._/hr" mask="99.99/hr" type="mask" />
    </FormField>
    <FormField label="Enter the date you started" required :error="form.errors.start_date">
        <FormControl v-model="form.start_date" type="date" />
    </FormField>
    <FormField label="Enter the date you finished" required :error="form.errors.end_date">
        <FormControl v-model="form.end_date" type="date" />
    </FormField>
    <FormField label="Termination Reason" required :error="form.errors.termination_reason">
        <FormControl v-model="form.termination_reason" type="textarea" placeholder="Termination reason" />
    </FormField>
</template>