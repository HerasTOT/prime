<script setup>
import FormControl from '@/Components/FormControl.vue';
import FormField from '@/Components/FormField.vue';
import { inject } from 'vue';
import { mdiCurrencyUsd } from '@mdi/js';

const form = inject('form');

const formatSalary = () => {
    if (form.salary !== null && form.salary !== '') {
        form.salary = parseFloat(form.salary).toFixed(2)
    }
}

</script>

<template>
    <FormField label="Position" required>
        <FormControl v-model="form.position" placeholder="Enter your position in your previous job" />
    </FormField>
    <FormField label="Company" required>
        <FormControl v-model="form.company" placeholder="Enter the company name" />
    </FormField>
    <FormField label="Supervisor" required>
        <FormControl v-model="form.supervisor" placeholder="Enter the supervisor name" />
    </FormField>
    <FormField label="Address" required>
        <FormControl v-model="form.address" placeholder="Enter the company address" />
    </FormField>
    <FormField label="Company Phone" required :error="form.errors.company_phone">
        <FormControl v-model="form.company_phone" type="tel" placeholder="Enter the company phone" maxlength="10"
            pattern="[0-9]{10}" @input="form.company_phone = form.company_phone.replace(/\D/g, '').slice(0, 10)" />
    </FormField>

    <FormField label="Salary" required :error="form.errors.salary">
        <FormControl v-model="form.salary" :icon="mdiCurrencyUsd" type="number" placeholder="Enter your previous salary"
            min="0" step="0.01" class="pl-6" @blur="formatSalary" />
    </FormField>



    <FormField label="Enter the date you started" required>
        <FormControl v-model="form.start_date" type="date" />
    </FormField>
    <FormField label="Enter the date you finished" required>
        <FormControl v-model="form.end_date" type="date" />
    </FormField>
    <FormField label="Termination Reason" required>
        <textarea v-model="form.termination_reason" class="form-control w-full" rows="4"
            placeholder="Termination reason"></textarea>
    </FormField>
</template>