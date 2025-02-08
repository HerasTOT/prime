<script>
import { Link, useForm } from '@inertiajs/vue3';
import { mdiBallotOutline, mdiAccount, mdiMail, mdiGithub } from "@mdi/js";
import LayoutMain from '@/Layouts/LayoutMain.vue';
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";

export default {
    props: {
        titulo: { type: String, required: true },
        routeName: { type: String, required: true },
    },
    components: {
        LayoutMain,
        FormField,
        FormControl,
        BaseDivider,
        BaseButton,
        BaseButtons,
        CardBox,
        SectionTitleLineWithButton
    },
    setup() {
        const handleSubmit = () => {
            form.post(route('tratamientos.store'));
        };
        const validateNumericInput = (event) => {
            const value = event.target.value;
            event.target.value = value.replace(/\D/g, '');
            form.numero = event.target.value;
        };
        const form = useForm({
            nombre: '',
            precio: '',
        });

        return { handleSubmit,validateNumericInput, form, mdiBallotOutline, mdiAccount, mdiMail, mdiGithub }
    }
}
</script>

<template>
    <LayoutMain :title="titulo">
        <SectionTitleLineWithButton  :title="titulo" main>
            
        </SectionTitleLineWithButton>

        <CardBox form @submit.prevent="handleSubmit">
            <FormField >
                <FormControl v-model="form.nombre"  placeholder="Nombre del tratamiento"/>
            </FormField>   
            <FormField >
                <FormControl v-model="form.precio"    @input="validateNumericInput"  placeholder="Nombre del tratamiento"/>
            </FormField>  
         
            <template #footer>
                <BaseButtons>
                    <BaseButton @click="handleSubmit" type="submit" class="action-button" label="Crear" />
                    <BaseButton :href="route(`${routeName}index`)" type="reset" color="danger" outline
                        label="Cancelar" />
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