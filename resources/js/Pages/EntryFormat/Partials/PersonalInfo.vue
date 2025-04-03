<script setup>
import FormControl from '@/Components/FormControl.vue';
import FormField from '@/Components/FormField.vue';
import { inject } from 'vue';

const form = inject('form');

</script>

<template>
    <FormField label="Names" required :error="form.errors.names">
        <FormControl v-model="form.names" placeholder="Enter names" />
    </FormField>
    <FormField label="Second Name" required :error="form.errors.first_surname">
        <FormControl v-model="form.first_surname" placeholder="Enter second name" />
    </FormField>
    <FormField label="Last Name" :error="form.errors.second_surname">
        <FormControl v-model="form.second_surname" placeholder="Enter last name" />
    </FormField>
    <FormField label="Email" required :error="form.errors.email">
        <FormControl v-model="form.email" type="email" placeholder="Enter email" />
    </FormField>
    <FormField label="Phone Number" required help="Enter only 10 digits" :error="form.errors.phone">
        <FormControl v-model="form.phone" placeholder="Enter phone number" maxlength="10" />
    </FormField>
    <FormField label="Age" required :error="form.errors.age">
        <FormControl v-model="form.age" type="number" placeholder="Enter age" />
    </FormField>
    <FormField label="Birthdate" required :error="form.errors.birthdate">
        <FormControl v-model="form.birthdate" type="date" />
    </FormField>
    <FormField label="Social Security Number (SSN)" required :error="form.errors.ssn"
        help="A 9-digit number issued by the U.S. government for identification and tax purposes.">
        <FormControl v-model="form.ssn" placeholder="Enter your social security" maxlength="9" />
    </FormField>
</template>