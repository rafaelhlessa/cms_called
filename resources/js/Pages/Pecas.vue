<template>
    <Head title="Estoque" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Estoque</h2>
        </template>

        <div class="py-12 p-2">
            <div class="bg-white py-8 px-4 rounded rounded-lg shadow-2xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <button type="button"
                                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Novo Item</button>
                        </div>
                    </div>
                    <div class="-mx-4 mt-10 ring-1 ring-gray-300 sm:mx-0 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Descrição
                                    </th>
                                    <th scope="col"
                                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                        Quantidade/Estoque</th>
                                    <th scope="col"
                                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                        Tipo</th>
                                    <th scope="col"
                                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                        Data Compra</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Preço
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Select</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="plan in parts" :key="plan.id">
                                    <td class="border-t border-transparentrelative py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="font-medium text-gray-900">
                                            {{ plan.description }}
                                        </div>
                                        <div class="absolute -top-px left-6 right-0 h-px bg-gray-200" />
                                    </td>
                                    <td
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        <b class="text-lg">{{ plan.amount }}</b>  Peças</td>
                                    <td v-if="plan.pm_parts === 1"
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        Peça PMSC</td>
                                    <td v-else
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        Peça Ilha Service</td>    
                                    <td
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        {{ plan.buy_date }}</td>
                                    <td
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        R$ {{ plan.price }}</td>
                                    <td
                                        class="border-t border-transparentrelative py-3.5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <button type="button"
                                            class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                                            Estoque<span class="sr-only">, {{ plan.id }}</span>
                                        </button>
                                        <div class="absolute -top-px left-0 right-6 h-px bg-gray-200" />
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
    props: ['errors', 'data', 'parts'],

    data() {
        return {
            editMode: false,
            errors: [],
            // form: {
            //     name: null,
            //     phone: null,
            //     glpi: null,
            //     pim: null,
            //     status_id: null,
            //     service: null,
            // },

        }
    },
    methods: {
        // reset: function () {
        //     this.form = {
        //         name: null,
        //         phone: null,
        //         glpi: null,
        //         pim: null,
        //         status_id: null,
        //         service: null,
        //     }
        // },
        // save: function (data) {
        //     console.log(data)
        //     this.$inertia.post('/call', data)

        //     // this.reset();
        //     this.editMode = false;
        // },


    },
}
</script>