<script setup>
import FormControl from '@/Components/FormControl.vue';
import FormField from '@/Components/FormField.vue';
import { inject, provide, watch, ref } from 'vue';
import { VueSignaturePad } from "@selemondev/vue3-signature-pad";
import BaseButton from '@/Components/BaseButton.vue';
import { mdiArrowULeftTop, mdiBroom } from '@mdi/js';

const form = inject('form');
const { signature, options, undoCanvas, clearCanvas } = inject('useSignature');

</script>

<template>
    <h2 class="text-xl font-bold mb-4">Document</h2>
    <FormField label="Front of ID" help="Select a photo of the front of your ID">
        <FormControl type="file" height="h-10.5" @input="form.idFront = $event.target.files[0]" />
    </FormField>

    <FormField label="Back of ID" help="Select a photo from the back of your ID">
        <FormControl type="file" height="h-10.5" @input="form.idBack = $event.target.files[0]" />
    </FormField>

    <FormField label="Social security" help="Select a photo of your social security number">
        <FormControl type="file" height="h-10.5" @input="form.security = $event.target.files[0]" />
    </FormField>

    <FormField label="Selfie" help="Select a selfie">
        <FormControl type="file" height="h-10.5" @input="form.selfie = $event.target.files[0]" />

    </FormField>

    <FormField label="CV" help="Select a file of your CV">
        <FormControl type="file" height="h-10.5" @input="form.cv = $event.target.files[0]" />
    </FormField>
    <FormField required label="Signature" :error="form.errors.signature">
        <div class="relative bg-gray-100 border border-black">
            <VueSignaturePad ref="signature" height="400px" width="auto" :options="options" />

            <div class="absolute flex flex-col space-y-2 top-3 right-4">
                <BaseButton @click="undoCanvas" :icon="mdiArrowULeftTop" />
                <BaseButton @click="clearCanvas" :icon="mdiBroom" />
            </div>
        </div>
    </FormField>

    {{ signature }}
</template>