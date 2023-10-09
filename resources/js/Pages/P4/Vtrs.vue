<template>
    <Head title="Viaturas" />

    <div>
        <div class="min-h-screen bg-gray-600 dark:bg-gray-900">
            <div class="p-2 py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="drop-shadow-xl">
                        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6 rounded-t-lg">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">P4 - DTIC/PMSC</h3>
                            <p class="mt-1 text-sm text-gray-500">Viaturas na carga de DTIC.</p>
                        </div>
                        <div class="overflow-hidden p-4 bg-white shadow-sm dark:bg-gray-800 sm:rounded-b-lg">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                <div v-for="car in cars" :key="car.id" class="relative flex items-center m-2 space-x-6 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                                    <div class="min-w-0 ml-4 mb-12 flex-1">
                                        <a :href="route('outVtr', car.id)" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true" />
                                            <p class="text-sm font-medium text-gray-900">{{ car.plate }}</p>
                                            <p class="truncate text-sm text-gray-500">{{ car.brandmodel }}</p>
                                            <b v-if="car.used === 0" class="absolute mt-2 mb-2 px-3 py-3 sm:p-3 bg-green-300 rounded-lg">Livre</b>
                                            <b v-else class="absolute mt-2 mb-2 px-3 py-3 sm:p-3 bg-red-300 rounded-lg">Em Uso</b>
                                        </a>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <img class="h-full mr-4 text-white" :src="'/storage/'+car.qrcode" alt="Oficial" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
    name: "Vtrs",
    components: {
        AuthenticatedLayout,
        Head,

    },
    props: ['errors', 'cars', 'driver', 'usedvtr'],

    data() {
        return {
            editMode: false,
            errors: [],
        }
    },
    methods: {

    },
}
</script>
