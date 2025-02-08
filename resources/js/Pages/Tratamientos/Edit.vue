<script setup>
import { ref, defineProps, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import LayoutMain from '@/Layouts/LayoutMain.vue';
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import Swal from 'sweetalert2';

const props = defineProps(['titulo', 'Tratamientos', 'routeName']);
const form = useForm({ ...props.Tratamientos });

const guardar = () => {
    form.put(route("tratamientos.update", props.Tratamientos.id));
};

</script>

<template>
    <LayoutMain :title="titulo">
        <SectionTitleLineWithButton  :title="titulo" main>
          
        </SectionTitleLineWithButton>

        <CardBox form @submit.prevent="guardar">
            
            <FormField label="nombre">
                <FormControl v-model="form.nombre"  placeholder="Nombre del tratamiento"/>
            </FormField>
            <FormField label="precio">
                <FormControl v-model="form.precio"  placeholder="Precio del tratamiento"/>
            </FormField>
           
            <template #footer>
                <BaseButtons>
                    <BaseButton @click="guardar" type="submit" color="action-button" label="Actualizar" />
                    <BaseButton :href="route(`${routeName}index`)" type="reset" color="danger" outline label="Cancelar" />
                </BaseButtons>
            </template>
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
  
</style>