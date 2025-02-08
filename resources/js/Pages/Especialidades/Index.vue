<script>
import { Link, useForm } from '@inertiajs/vue3';
import Swal from "sweetalert2";
import Pagination from '@/Shared/Pagination.vue';
import LayoutMain from '@/Layouts/LayoutMain.vue';
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
        Especialidades: {
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
            nombre: '',
            
        });
        const eliminar = (id) => {
            Swal.fire({
                title: "¿Esta seguro?",
                text: "Esta acción no se puede revertir",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Si!, eliminar registro!",
            }).then((res) => {
                if (res.isConfirmed) {
                    form.delete(route("especialidades.destroy", id));
                }
            });
        };

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
        <SectionTitleLineWithButton  :title="titulo" main>
            <BaseButton :href="'especialidades/create'" class="action-button" label="Agregar nueva especialidad" />
        </SectionTitleLineWithButton>
       
        <NotificationBar v-if="$page.props.flash.success" color="success" :icon="mdiInformation" :outline="false">
            {{ $page.props.flash.success }}
        </NotificationBar>

        <NotificationBar v-if="$page.props.flash.error" color="danger" :icon="mdiInformation" :outline="false">
            {{ $page.props.flash.error }}
        </NotificationBar>

        <CardBox v-if="Especialidades.data.length < 1">
            <CardBoxComponentEmpty />
        </CardBox>

        <CardBox v-else class="mb-6" has-table>
            <table>
                <thead>
                    <tr>
                        <th />
                        <th>Nombre</th>
                       
                        <th></th>
                        <th />
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in Especialidades.data" :key="item.id">
                        <td class="align-items-center">
                           
                        </td>
                        <td data-label="Nombre">
                            {{ item.nombre }}
                        </td>

                        <td class="before:hidden lg:w-1 whitespace-nowrap">
                            <BaseButtons type="justify-start lg:justify-end" no-wrap>
                                <BaseButton class="icon" :icon="mdiApplicationEdit" small
                                    :href="route(`${routeName}edit`, item.id)" />
                                <BaseButton class="iconred" :icon="mdiTrashCan" small @click="eliminar(item.id)" />
                            </BaseButtons>
                        </td>

                    </tr>
                </tbody>
            </table>



            <Pagination :currentPage="Especialidades.current_page" :links="Especialidades.links"
                :total="Especialidades.links.length - 2"></Pagination>
        </CardBox>

    </LayoutMain>
</template>
<style scoped>
.action-button {
    margin-left: 20px;
    background-color: #4F1F91; 
    color: #fff;
    text-align: center;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    border: none; 
    cursor: pointer;
  }
  .action-button:hover {
    background-color: #FBB034; 
  }
  .icon{
    background-color: #FBB034; 
    color: #fff;
  }
  .iconred{
    background-color: #F50003; 
    color: #fff;
  }
</style>