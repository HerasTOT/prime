<script>
import { Link, useForm } from '@inertiajs/vue3';
import Swal from "sweetalert2";
import Pagination from '@/Shared/Pagination.vue';
// import LayoutMain from '@/layouts/LayoutMain.vue';
import {
    mdiMonitorCellphone,
    mdiTableBorder,
    mdiTableOff,
    mdiGithub,
    mdiApplicationEdit, mdiTrashCan
} from "@mdi/js";

import TableSampleClients from "@/Components/TableSampleClients.vue";
import CardBox from "@/Components/CardBox.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import BaseLevel from "@/Components/BaseLevel.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBoxComponentEmpty from "@/Components/CardBoxComponentEmpty.vue";
import NotificationBar from "@/Components/NotificationBar.vue";



export default {
    props: {
        titulo: { type: String, required: true },
        FormatEntry: {
            type: Object,
            required: true
        },
        routeName: { type: String, required: true },
        loadingResults: { type: Boolean, required: true, default: true }
    },
    components: {
        Link,
        LayoutMain,
        CardBox,
        TableSampleClients,
        SectionTitleLineWithButton,
        BaseLevel,
        BaseButtons,
        BaseButton,
        CardBoxComponentEmpty,
        Pagination,
        NotificationBar
    },
    setup() {
        const form = useForm({
            name: '',
            paternalSurname: '',
            maternalSurname: '',
            phone:'',
            age:'',
            birthdate:'',
            ssn:'',
           
        });
        
        return {
            form, eliminar, mdiMonitorCellphone,
            mdiTableBorder,
            mdiTableOff,
            mdiGithub,
            mdiApplicationEdit, mdiTrashCan,
        }
    }

}
</script>

<template>
    <LayoutMain>
        <!-- <SectionTitleLineWithButton  :title="titulo" main>
            <BaseButton :href="'periodo/create'" color="warning" label="Agregar período" />
        </SectionTitleLineWithButton> -->
       
        <NotificationBar v-if="$page.props.flash.success" color="success" :icon="mdiInformation" :outline="false">
            {{ $page.props.flash.success }}
        </NotificationBar>

        <NotificationBar v-if="$page.props.flash.error" color="danger" :icon="mdiInformation" :outline="false">
            {{ $page.props.flash.error }}
        </NotificationBar>

        <!-- <CardBox v-if="Periodo.data.length < 1">
            <CardBoxComponentEmpty />
        </CardBox>

        <CardBox v-else class="mb-6" has-table>
            <table>
                <thead>
                    <tr>
                        <th />
                        <th>Periodo</th>
                        <th>Año</th>
                        <th>Nomenclatura</th>
                        
                        <th></th>
                        <th />
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in Periodo.data" :key="item.id">
                        <td class="align-items-center">
                            
                        </td>
                        <td data-label="Periodo">
                            {{ item.periodo }}
                        </td>
                        <td data-label="Año">
                            {{ item.año }}
                        </td>
                        <td data-label="nomenclatura">
                            {{ item.nomenclatura }}
                        </td>
                        
                        <td class="before:hidden lg:w-1 whitespace-nowrap">
                            <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                <BaseButton color="warning" :icon="mdiApplicationEdit" small
                                    :href="route(`${routeName}edit`, item.id)" />
                                <BaseButton color="danger" :icon="mdiTrashCan" small @click="eliminar(item.id)" />
                            </BaseButtons>
                        </td>

                    </tr>
                </tbody>
            </table>



            <Pagination :currentPage="Periodo.current_page" :links="Periodo.links"
                :total="Periodo.links.length - 2"></Pagination>
        </CardBox> -->

    </LayoutMain>
</template>
