<script setup>
import { ref, reactive, watch,provide } from "vue";
import { debounce } from "lodash";
import { router } from "@inertiajs/vue3"; // Aquí importamos `router` de @inertiajs/vue3
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import {
    mdiBallotOutline,
    mdiInformation,
    mdiPencil,
    mdiBroom,
    mdiMagnify,
    mdiPlus
} from "@mdi/js";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    format: {
        type: Object,
        required: true,
    },
    routeName: {
        type: String,
        required: true,
    },
    search: {
        type: String,
        required: false,
        default: "",
    },
    direction: {
        type: String,
        required: false,
        default: "desc",
    },
    order: {
        type: String,
        required: false,
        default: "created_at",
    },
});

const search = ref(props.search);
const isLoading = ref(false);

const state = reactive({
    filters: {
        search: search,
        order: props.order,
        direction: props.direction,
    },
});

watch(
    search,
    debounce(function (value) {
        isLoading.value = true;
        router.get(route(`${props.routeName}index`, state.filters, { replace: true }));
    }, 500)
);

const cleanFilters = () => {
    isLoading.value = true;
    router.get(route(`${props.routeName}index`));
};

const filterBy = (order, direction) => {
    state.filters.order = order;
    state.filters.direction = direction;
    isLoading.value = true;
    router.get(route(`${props.routeName}index`, state.filters));
};

const filtrar = () => {
    isLoading.value = true;
    router.get(route(`${props.routeName}index`, state.filters));
};

const opts = [
    {
        label: "Nombre",
        key: "name",
        menu: [
            { title: "Ordenar desde A - Z", direction: "asc" },
            { title: "Ordenar desde Z - A", direction: "desc" },
        ],
    },
    {
        label: "Email",
        key: "email",
        menu: [
            { title: "Ordenar desde A - Z", direction: "asc" },
            { title: "Ordenar desde Z - A", direction: "desc" },
        ],
    },
];

provide("filterBy", filterBy);
</script>

<template>
    <Head :title="title" />
    <LayoutMain>
       
        
        <SectionTitleLineWithButton
            :icon="mdiBallotOutline"
            :title="title"
            main
        />

        <form @submit.prevent="filtrar" class="w-full mb-5">
    <div class="flex flex-col md:flex-row justify-between">
        <div class="flex w-1/2">
            <!-- Filtro de búsqueda -->
            <div class="relative w-full mr-1 mb-4">
                <input
                    type="search"
                    id="search-dropdown"
                    class="block p-2.5 md:h-11 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-l-lg md:rounded-l-none rounded-r-lg md:border-l-gray-300 border-l-gray-300 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                    placeholder="Ingresa un parametro de búsqueda"
                    v-model="search"
                />
                <BaseButton
                    class="absolute top-0 right-0 h-full rounded-l-none rounded-r-lg"
                    @click="cleanFilters"
                    :icon="mdiBroom"
                    color="info"
                    title="Limpiar filtro"
                />
            </div>

            
          
        </div>

        <BaseButtons>
            <BaseButton
                :routeName="`${routeName}create`"
                color="info"
                :icon="mdiPlus"
                label="Contestar formato"
                class="w-full"
            />
        </BaseButtons>
    </div>
</form>


        <CardBox v-if="format.data.length > 0">
            <table>
                <thead>
                    <tr>
                        <th />
                        <th>
                            <Dropdown title="Nombre" :options="opts" />
                        </th>
                        <th>
                            <Dropdown title="Email" :options="opts" />
                        </th>
                        <th>Edad</th>
                        <th>Fecha de nacimiento</th>
                        <th>SSN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in format.data" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.paternalSurname }}</td>
                        <td>{{ item.maternalSurname }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.age }}</td>
                        <td>{{ item.birthdate }}</td>
                        <td>{{ item.ssn }}</td>
                    </tr>
                </tbody>
            </table>
        </CardBox>

        <CardBox v-else>
            <p>No data available.</p>
        </CardBox>

        <Pagination :data="format" />
    </LayoutMain>
</template>


<!-- <script setup>
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import Pagination from "@/Shared/Pagination.vue";
import { ref } from "vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    format: {
        type: Object,
        default: () => ({}),
        required: true,
    },
});
</script>

<template>
    <LayoutMain>
        <SectionTitleLineWithButton
            :title="title"
            main
        />
        
        <CardBox v-if="format.data.length > 0">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Paternal Surname</th>
                        <th>Maternal Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Age</th>
                        <th>Birthdate</th>
                        <th>SSN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in format.data" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.paternalSurname }}</td>
                        <td>{{ item.maternalSurname }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.age }}</td>
                        <td>{{ item.birthdate }}</td>
                        <td>{{ item.ssn }}</td>
                    </tr>
                </tbody>
            </table>
        </CardBox>
        <CardBox v-else>
            <p>No data available.</p>
        </CardBox>
    </LayoutMain>
</template> -->

