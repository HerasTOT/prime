<script setup>
import FormControl from '@/Components/FormControl.vue';
import FormField from '@/Components/FormField.vue';
import { inject } from 'vue';

const form = inject('form');

</script>

<template>
    <FormField label="Name" required :error="form.errors.name">
        <FormControl v-model="form.name" placeholder="Enter name" />
    </FormField>
    <FormField label="Middle Name" :error="form.errors.middle_name">
        <FormControl v-model="form.middle_name" placeholder="Enter middle name" />
    </FormField>
    <FormField label="Last Name" required :error="form.errors.last_name">
        <FormControl v-model="form.last_name" placeholder="Enter last name" />
    </FormField>
    <FormField label="Mother's Last Name" :error="form.errors.mother_last_name">
        <FormControl v-model="form.mother_last_name" placeholder="Enter last name" />
    </FormField>
    <FormField label="Email" required :error="form.errors.email">
        <FormControl v-model="form.email" type="email" placeholder="Enter email" />
    </FormField>
    <FormField label="Phone Number" required help="Enter only 10 digits" :error="form.errors.phone">
        <FormControl v-model="form.phone" type="tel" placeholder="Enter phone number" maxlength="10"
            @input="form.phone = form.phone.replace(/\D/g, '').slice(0, 10)" />
    </FormField>

    <FormField label="Age" required :error="form.errors.age">
        <FormControl v-model="form.age" type="tel" placeholder="Enter age" min="18" max="99"
            @input="form.age = form.age.replace(/\D/g, '').slice(0, 2)" />
    </FormField>

    <FormField label="Birthdate" required :error="form.errors.birthdate">
        <FormControl v-model="form.birthdate" type="date" />
    </FormField>
    <FormField label="Social Security Number (SSN)" required :error="form.errors.ssn"
        help="A 9-digit number issued by the U.S. government for identification and tax purposes.">
        <FormControl v-model="form.ssn" type="tel" placeholder="Enter your social security" maxlength="9"
            pattern="[0-9]{9}" @input="form.ssn = form.ssn.replace(/\D/g, '').slice(0, 9)" />
    </FormField>

</template>