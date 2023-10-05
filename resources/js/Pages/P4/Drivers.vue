<template>
    <Head title="Lista de Viaturas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Lista de Motoristas</h2>
        </template>

        <div class="p-2 py-12">
            <div class="px-4 py-8 bg-white rounded rounded-lg shadow-2xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">

                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a :href="route('driver.create')"
                               class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Novo Item</a>
                        </div>
                    </div>
                    <div class="mt-10 -mx-4 ring-1 ring-gray-300 sm:mx-0 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Nome
                                </th>
                                <th scope="col"
                                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                    Setor</th>
                                <th scope="col"
                                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                    Telefone</th>
                                <th scope="col"
                                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                    Exibir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="plan in drivers" :key="plan.id">
                                <td class="relative py-4 pl-4 pr-3 text-sm text-gray-500 border-t border-transparent sm:pl-6">
                                    <div class="text-lg">
                                        {{ plan.name }}
                                    </div>
                                    <div class="absolute right-0 h-px bg-gray-200 -top-px left-6" />
                                </td>
                                <td class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                    <b class="text-lg">{{ plan.location }}</b></td>
                                <td class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                    <b class="text-lg">{{ plan.phone }}</b></td>
<!--                                <td class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">-->
<!--                                    <div v-on="getBarColor" class="h-6 bg-gray-300 rounded-full" :style="{ width: plan.fuel + '%', backgroundColor: getBarColor(plan.fuel)}">-->
<!--                                        <b class="text-center mx-4">{{ plan.fuel }}%</b>-->
<!--                                    </div>-->


<!--                                </td>-->
<!--                                <td class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">-->
<!--                                    <b v-if="plan.used === 0" class="px-3 py-3 sm:p-3 bg-green-200 rounded-full">Não</b>-->
<!--                                    <b v-else class="px-3 py-3 sm:p-3 bg-red-200 rounded-full">Sim</b>-->
<!--                                </td>-->
                                <td class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                    <!-- class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white"> -->
                                    <a :href="route('car.edit', plan.id)">
                                        <img className="h-8 w-8 text-white" :src="`/storage/oficial.svg`" alt="Oficial" />
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
    name: "EntranceCreate",
    components: {
        AuthenticatedLayout,
        Head
    },
    props: ['errors', 'data', 'drivers'],

    data() {
        return {
            editMode: false,
            errors: [],
        }
    },
    methods: {
        // // Define a method to calculate the bar color based on the value.
        // getBarColor(value) {
        //     if (value === 100) {
        //         return '#04B404'; // Change to your desired color class
        //     } else if (value === 75) {
        //         return '#82FA58'; // Change to your desired color class
        //     } else if (value === 50) {
        //         return '#F7FE2E'; // Change to your desired color class
        //     } else if (value === 25) {
        //         return '#FE9A2E'; // Change to your desired color class
        //     } else {
        //         return '#DF0101'; // Change to your desired color class
        //     }
        // }
    },

}
</script>
