<template>
    <Head title="Adicionar de Viatura" />

    <div class="bg-gray-600 w-full">
        <div class="p-2 py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden p-4 bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div v-for="car in cars" :key="car.id" class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                            <div class="flex-shrink-0">
                                <img className="h-8 w-8 mr-4 text-white" :src="`/storage/oficial.svg`" alt="Oficial" />
                            </div>
                            <div class="min-w-0 ml-4  flex-1">
                                <a :href="route('outVtr', car.id)" class="focus:outline-none">
                                    <span class="absolute inset-0" aria-hidden="true" />
                                    <p class="text-sm font-medium text-gray-900">{{ car.plate }}</p>
                                    <p class="truncate text-sm text-gray-500">{{ car.brandmodel }}</p>
                                </a>
                            </div>
                            <div class="min-w-0 ml-4  flex-1">
                                <b v-if="car.used === 0" class="px-3 py-3 sm:p-3 bg-green-300 rounded-lg">Livre</b>
                                <b v-else class="px-3 py-3 sm:p-3 bg-red-300 rounded-lg">Em Uso</b>
                            </div>
                            <div class="flex-shrink-0">
                                <img className="h-10 w-10 mr-4 text-white" :src="'/storage/'+ car.qrcode" alt="Oficial" />
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
