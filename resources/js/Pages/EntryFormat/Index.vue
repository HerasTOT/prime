<script setup>
import { ref, reactive, watch, provide } from "vue";
import { debounce } from "lodash";
import { router } from "@inertiajs/vue3"; // Aquí importamos `router` de @inertiajs/vue3
import CardBox from "@/Components/CardBox.vue";
import LayoutMain from "@/Layouts/LayoutMain.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import Pagination from '@/Shared/Pagination.vue';
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


const showModal = ref(false);
const selectedItem = ref({});

const openModal = (item) => {
    selectedItem.value = item; // Asigna el objeto seleccionado
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};
</script>

<template>

    <Head :title="title" />
    <LayoutMain>


        <SectionTitleLineWithButton :icon="mdiBallotOutline" :title="title" main />

        <form @submit.prevent="filtrar" class="w-full mb-5">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="flex w-1/2">
                    <!-- Filtro de búsqueda -->
                    <div class="relative w-full mr-1 mb-4">
                        <input type="search" id="search-dropdown"
                            class="block p-2.5 md:h-11 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-l-lg md:rounded-l-none rounded-r-lg md:border-l-gray-300 border-l-gray-300 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            placeholder="Ingresa un parametro de búsqueda" v-model="search" />
                        <BaseButton class="absolute top-0 right-0 h-full rounded-l-none rounded-r-lg"
                            @click="cleanFilters" :icon="mdiBroom" color="info" title="Limpiar filtro" />
                    </div>



                </div>


            </div>
        </form>


        <CardBox v-if="format.data.length > 0">
            <table>
                <thead>
                    <tr>

                        <th>
                            Name
                            <Dropdown title="Nombre" :options="opts" />
                        </th>
                        <th> Middle name </th>
                        <th> Paternal Surname</th>
                        <th> Maternal Surname</th>
                        <th>
                            Email
                            <Dropdown title="Email" :options="opts" />
                        </th>
                        <th>Phone</th>
                        <th>Age</th>
                        <th>Information</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in format.data" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.middle_name }}</td>
                        <td>{{ item.last_name }}</td>
                        <td>{{ item.mother_last_name }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.age }}</td>
                        <td>
                            <button @click="openModal(item)" class="bg-blue-600 text-white px-3 py-1 rounded-md">
                                See information
                            </button>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </CardBox>

        <CardBox v-else>
            <p>No data available.</p>
        </CardBox>

        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 max-h-[90vh] overflow-y-auto">
                <h2 class="text-lg font-bold mb-4"> Personal information</h2>

                <p><strong>Name: </strong>{{ selectedItem.name }}</p>
                <p><strong>Middle name: </strong>{{ selectedItem.middle_name }}</p>
                <p><strong>Paternal Surname: </strong>{{ selectedItem.last_name }}</p>
                <p><strong>Maternal Surname: </strong>{{ selectedItem.mother_last_name }}</p>
                <p><strong>Email: </strong>{{ selectedItem.email }}</p>
                <p><strong>Phone: </strong>{{ selectedItem.phone }}</p>
                <p><strong>Age: </strong>{{ selectedItem.age }}</p>
                <p><strong>Birthdate: </strong> {{ selectedItem.birthdate }}</p>
                <p><strong>SSN: </strong> {{ selectedItem.ssn }}</p>

                <hr class="my-4" />
                <h3 class="text-md font-semibold mb-2">Work experience</h3>
                <p><strong>Position: </strong>{{ selectedItem.experience?.position }}</p>
                <p><strong>Company: </strong>{{ selectedItem.experience?.company }}</p>
                <p><strong>Supervisor: </strong>{{ selectedItem.experience?.supervisor }}</p>
                <p><strong>Address: </strong>{{ selectedItem.experience?.address }}</p>
                <p><strong>Phone Company: </strong>{{ selectedItem.experience?.company_phone }}</p>
                <p><strong>Salary: </strong>{{ selectedItem.experience?.salary }}</p>
                <p><strong>Start Date: </strong>{{ selectedItem.experience?.start_date }}</p>
                <p><strong>End Date: </strong>{{ selectedItem.experience?.end_date }}</p>
                <p><strong>Reason for leaving: </strong>{{ selectedItem.experience?.termination_reason }}</p>


                <hr class="my-4" />
                <h3 class="text-md font-semibold mb-2">Skills</h3>
                <ul class="list-disc list-inside" v-if="selectedItem.skills && selectedItem.skills.length > 0">
                    <li v-for="(skill, index) in selectedItem.skills" :key="index">
                        {{ skill.name }} - {{ skill.description }}
                    </li>
                </ul>
                <p v-else class="text-gray-500 italic">There are no registered skills.</p>


                <hr class="my-4" />
                <h3 class="text-md font-semibold mb-2">Desired jobs</h3>
                <ul class="list-disc list-inside"
                    v-if="selectedItem.desired_jobs && selectedItem.desired_jobs.length > 0">
                    <li v-for="(job, index) in selectedItem.desired_jobs" :key="index">
                        {{ job.name }} - {{ job.description }}
                    </li>
                </ul>
                <p v-else class="text-gray-500 italic">There are no registered skills.</p>

                <hr class="my-4" />
                <h3 class="text-md font-semibold mb-2">Files</h3>
                <ul class="list-disc list-inside" v-if="selectedItem.files && selectedItem.files.length > 0">
                    <li v-for="(file, index) in selectedItem.files" :key="index">
                        <a :href="file.path" target="_blank" class="text-blue-600">{{ file.name }}</a>
                        ({{ (file.size / 1024).toFixed(2) }} KB)
                        <span class="text-gray-500">{{ file.mime_type }}</span>
                    </li>
                </ul>
                <p v-else class="text-gray-500 italic">No files uploaded.</p>
                <button @click="closeModal" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded-md w-full">
                    Close
                </button>
                
            </div>
        </div>


        <Pagination :data="format" />
    </LayoutMain>
</template>
