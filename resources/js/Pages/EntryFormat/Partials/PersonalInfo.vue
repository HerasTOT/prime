<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import CardBoxComponentEmpty from '@/Components/CardBoxComponentEmpty.vue';
import FormControl from '@/Components/FormControl.vue';
import FormField from '@/Components/FormField.vue';
import { ref } from 'vue';
import { inject } from 'vue';

const maxUserLanguages = 3;
const userLanguages = ref({ language_id: null, level_id: null });
const form = inject('form');
const { countries } = inject('props');
const { languages } = inject('props');
const { levels } = inject('props');

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
    <FormField label="Country" required :error="form.errors.country_id">
        <FormControl v-model="form.country_id" :options="countries" />
    </FormField>

    <FormField class="w-full" label="Language" :error="form.errors.language_id" required>
        <FormControl v-model="form.language_id" :options="languages" placeholder="Select language" />
    </FormField>
    <!-- <div>
        <div class="mb-5 flex flex-col lg:mb-0 lg:flex-row">
            <div class="w-full flex justify-start space-x-2">
                <FormField class="w-full" label="Language">
                    <FormControl v-model="userLanguages.language_id" :options="languages" placeholder="Select language" />
                </FormField>
                <FormField class="w-full" label="Level">
                    <FormControl v-model="userLanguages.level_id" :options="levels" placeholder="Select level" />
                </FormField>
            </div>

            <div class="mt-5 gap-2 flex lg:flex-row lg:mt-8 lg:ml-2">
                <BaseButton class="w-full h-12" label="Agregar" v-if="!showEdit"
                    :disabled="form.languages?.length === maxUserLanguages ? true : false" color="info"
                    :icon="mdiPlus" @click="addPhoneNumber" />

                <BaseButton class="w-full h-12" label="Guardar" v-if="showEdit" color="success" :icon="mdiContentSave"
                    @click="updatePhoneNumber" />

            </div>
        </div>

        <table v-if="form.languages?.length > 0">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Language</th>
                    <th>Level</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(l, index) in form.languages" :key="index">
                    <td data-label="N°">
                        {{ index + 1 }}
                    </td>
                    <td data-label="Language" class="flex flex-col">
                        {{ l.language_id }}
                        <span v-if="form.errors['languages.' + index]" class="text-red-700">
                            Teléfono en uso
                        </span>
                    </td>

                    <td data-label="Acciones">
                        <BaseButtons>
                            <BaseButton color="info" :icon="mdiPencil" @click="editPhoneNumber(index)" small
                                title="Editar" />
                            <BaseButton color="danger" :icon="mdiTrashCan" @click="removePhoneNumber(index)" small
                                title="Eliminar" />
                        </BaseButtons>
                    </td>
                </tr>
            </tbody>
        </table>
        <CardBoxComponentEmpty v-else />
    </div> -->

    <FormField label="Social Security Number (SSN)" required :error="form.errors.ssn"
        help="A 9-digit number issued by the U.S. government for identification and tax purposes.">
        <FormControl v-model="form.ssn" type="tel" placeholder="Enter your social security" maxlength="9"
            pattern="[0-9]{9}" @input="form.ssn = form.ssn.replace(/\D/g, '').slice(0, 9)" />
    </FormField>
</template>