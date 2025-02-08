<script setup>
import { ref, inject, onMounted, reactive, computed } from "vue";
import BaseIcon from "@/Components/BaseIcon.vue";
import {
    mdiArrowUpDropCircleOutline,
    mdiArrowDownDropCircleOutline,
} from "@mdi/js";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    options: {
        type: Object,
        required: false,
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const show = ref(false);

const filter = inject("filterBy");

const fp = computed(() => {
    const option = props.options.find((option) => option.label === props.title);
    return option;
});

</script>

<template>
    <div class="relative inline-block text-left">
        <div class="max-w-xs">
            <button
                type="button"
                class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-md font-bold text-gray-900 dark:text-white ring-inset ring-gray-300 hover:bg-gray-100"
                @click="show = !show"
            >
                {{ title }}
                <BaseIcon
                    class="transition duration-150 ease-in-out"
                    :path="
                        show
                            ? mdiArrowDownDropCircleOutline
                            : mdiArrowUpDropCircleOutline
                    "
                />
            </button>
        </div>

        <div
            v-show="show"
            class="absolute z-10 mt-2 w-56 origin-top-right divide-gray-100 rounded-md bg-white dark:bg-gray-700 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transition duration-150 ease-in-out"
            aria-orientation="vertical"
        >
            <div
                class=""
                v-for="option in fp.menu"
                :key="option"
            >
                <span
                    class="text-gray-700 dark:text-white block px-4 py-2 text-sm hover:bg-gray-100 hover:dark:bg-slate-600 cursor-pointer"
                    @click="filter(fp.key, option.direction, option.status)"
                >
                    {{ option.title }}
                </span>
            </div>
        </div>
    </div>
</template>
