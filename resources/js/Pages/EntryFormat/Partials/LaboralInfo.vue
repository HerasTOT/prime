<script setup>
import FormControl from '@/Components/FormControl.vue';
import FormField from '@/Components/FormField.vue';
import { inject } from 'vue';

const form = inject('form');

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
    <FormField label="Company Phone" required>
        <FormControl v-model="form.company_phone" placeholder="Enter the company phone" />
    </FormField>
    <FormField label="Salary" required>
        <FormControl v-model="form.salary" type="number" placeholder="Enter your previous salary" />
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