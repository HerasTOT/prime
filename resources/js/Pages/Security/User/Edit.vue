<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPencil, mdiTrashCan, mdiContentSave, mdiClose } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { provide } from "@vue/runtime-core";
import DataFormEdit from "./DataFormEdit.vue";
import axios from 'axios'

const props = defineProps({
    name: 'Edit',
    title: String,
    user: Object,
    profiles: Array,
    permissions: Object,
    modules: Array,
    routeName: { type: String, required: true },
});
const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: null,
    profiles: [...props.user.roles.map(p => ({ id: p.id, name: p.name }))],
    permissions: [...props.user.permissions.map(p => ({ id: p.id, name: p.name }))],
});

const saveForm = () => {
    form.transform(data => ({
        ...data,
        profiles: data.profiles.map(p => p.id),
        permissions: data.permissions.map(p => p.id),
    })).put(route(`${props.routeName}update`, props.user.id))
};

const deleteForm = () => {
    Swal.fire({
        title: '¿Esta seguro?',
        text: 'Esta acción no se puede revertir',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#1C64F2",
        confirmButtonColor: "#E02424",
        confirmButtonText: "Si!, eliminar registro!",
    }).then(res => {
        if (res.isConfirmed) form.delete(route(`${props.routeName}destroy`, props.user.id));
    });
};

provide('form', form);
provide('profiles', props.profiles);
provide('permissions', props.permissions);
provide('modules', props.modules);

</script>

<template>

    <Head :title="title" />
    <LayoutMain>
        <SectionTitleLineWithButton :icon="mdiPencil" :title="title" main>
            <Link :href="route(`${routeName}index`)">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x"
                viewBox="0 0 16 16">
                <path
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
            </Link>
        </SectionTitleLineWithButton>
        <CardBox form @submit.prevent="saveForm">
            <DataFormEdit />
            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancelar" />
                    <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success"
                        label="Guardar" />
                    <BaseButton color="danger" :icon="mdiTrashCan" @click="deleteForm" label="Eliminar" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
