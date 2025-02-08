<script>
import SectionMain from "@/Components/SectionMain.vue";
import CardBox from "@/Components/CardBox.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiBallotOutline, mdiPencil } from "@mdi/js";
import SectionTitle from "@/Components/SectionTitle.vue";

import { defineProps } from 'vue';
import { Link } from "@inertiajs/vue3";
import JetLabel from "@/Components/Label.vue";
import JetInput from "@/Components/Input.vue";
import JetButton from "@/Components/Button.vue";
import Button from "@/Components/PrimaryButton.vue";

import JetInputError from "@/Components/InputError.vue";
import Pagination from "@/Shared/Pagination.vue";
import JetDangerButton from "@/Components/DangerButton.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, inject, reactive, ref, toRefs } from "vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
    name: "DataForm",
    components: {
        SectionMain, LayoutAuthenticated, SectionTitleLineWithButton,
        Pagination,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetDangerButton,
        Button,
        FormField,
        FormControl,
        vSelect,
    },
    setup() {
        const form = inject("form");
        const profiles = inject("profiles");

        const isChecked = (permission) =>
            form.permissions.some((permiso) => permission.id === permiso.id);

        // Associate profile and select all permissions
        const associateProfile = (profile) => {
            if (form.profiles.some((item) => profile.id === item.id)) {
                profile.permissions.forEach((item) =>
                    form.permissions.push({ id: item.id, name: item.name })
                );
            } else {
                profile.permissions.forEach((item) => {
                    const index = form.permissions.findIndex(
                        (formItem) => formItem.id === item.id
                    );
                    if (index > -1) {
                        form.permissions.splice(index, 1);
                    }
                });
            }
        };

        const isCheckedProfile = (profile) =>
            form.profiles.some((item) => profile.id === item.id);


        return {
            form,
            associateProfile,
            isCheckedProfile,
            profiles,
            isChecked,
        };
    },
};
</script>

<template>
    <div class="md:flex md:space-x-4 mb-5">
        <div class="md:w-1/2 max-lg:mb-5">
            <FormField label="Nombre del usuario:" :required="true" :error="form.errors.name">
                <FormControl v-model="form.name" placeholder="Nombre del usuario" />
            </FormField>
        </div>
        <div class="md:w-1/2">
            <FormField label="Correo Electrónico:" :required="true" :error="form.errors.email">
                <FormControl v-model="form.email" type="email" placeholder="Correo Electrónico" />
            </FormField>
        </div>
    </div>
    <FormField label="Contraseña:" :required="true" :error="form.errors.password">
        <FormControl v-model="form.password" placeholder="Contraseña" type="password" />
    </FormField>
    <FormField label="Selecciona un rol:" :required="true" help="Puedes asignarle uno o más roles al usuario">
        <table class="mb-5">
            <thead>
                <tr>
                    <th />
                    <th>Nombre de Rol</th>
                    <th>Descripción</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in profiles" :key="item.id">
                    <td class="align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-book-half" viewBox="0 0 16 16">
                            <path
                                d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                        </svg>
                    </td>
                    <td data-label="Nombre">
                        {{ item.name }}
                    </td>
                    <td data-label="Descripción">
                        {{ item.description }}
                    </td>
                    <td data-label="Estatus">
                        <label class="relative inline-flex items-center mb-5 cursor-pointer" :for="`chk${item.id}`">
                            <input type="checkbox" class="sr-only peer" v-model="form.profiles"
                                :value="{ id: item.id, name: item.name }" :id="`chk${item.id}`"
                                :checked="isCheckedProfile(item)" @change="associateProfile(item)">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            </span>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
    </FormField>
</template>
