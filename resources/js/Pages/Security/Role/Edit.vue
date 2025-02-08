<script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { mdiPencil, mdiTrashCan, mdiContentSave, mdiClose } from "@mdi/js";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import { Link, Head, router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { provide } from "@vue/runtime-core";
import DataForm from "./DataForm.vue";

const props = defineProps({
    name: 'Edit',
    title: { type: String, required: true },
    perfil: { type: Object, required: true, default: {} },
    permisos: { type: Object, required: true, default: {} },
    modules: { type: Object, required: true, default: {} },
    routeName: { type: String, required: true },
});
const form = useForm({
    name: props.perfil.name,
    description: props.perfil.description,
    guard_name: props.perfil.guard_name,
    permisos: [...props.perfil.permissions.map(p => ({ id: p.id, name: p.name }))],
});
const saveForm = () => form.transform(data => ({ ...data, permisos: data.permisos.map(p => p.id) })).put(route(`${props.routeName}update`, props.perfil.id))
const deleteForm = () => {
    Swal.fire({
        title: "¿Esta seguro?",
        text: "Esta acción no se puede revertir",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#1C64F2",
        confirmButtonColor: "#E02424",
        confirmButtonText: "Si!, eliminar registro!",
    }).then((res) => {
        if (res.isConfirmed) {
            form.delete(route("perfiles.destroy", props.perfil.id));
        }
    });
};
provide('form', form);
provide('permisos', props.permisos);
provide('modulos', props.modules);


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
            <DataForm />

            <template #footer>
                <BaseButtons>
                    <BaseButton :routeName="`${routeName}index`" :icon="mdiClose" color="white" label="Cancelar" />
                    <BaseButton @click="saveForm" :icon="mdiContentSave" type="submit" color="success" label="Guardar"/>
                    <BaseButton color="danger" :icon="mdiTrashCan" @click="deleteForm" label="Eliminar" />
                </BaseButtons>
            </template>
        </CardBox>
    </LayoutMain>
</template>
