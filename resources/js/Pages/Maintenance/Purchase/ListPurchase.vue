<template>
    <Head title="Lista de Peças" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Lista de Compras</h2>
        </template>

        <div class="p-2 py-12">
            <div class="px-4 py-8 bg-white rounded rounded-lg shadow-2xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">

                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a :href="route('purchase.create')"
                                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Novo Item</a>
                        </div>
                    </div>
                    <div class="mt-10 -mx-4 ring-1 ring-gray-300 sm:mx-0 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Peça
                                    </th>
                                    <th scope="col"
                                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                        Quantidade</th>
                                    <th scope="col"
                                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                        Data Compra</th>
                                    <th scope="col"
                                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                        Preço Unitário</th>
                                    <th scope="col"
                                        class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                        Preço Total</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Exibir</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="plan in purchase" :key="plan.id">
                                    <td class="relative py-4 pl-4 pr-3 text-sm border-t border-transparent sm:pl-6">
                                        <!-- <div v-if="plan.parts.description == null" class="font-medium text-gray-900">
                                            Não tem
                                        </div> -->
                                        <div class="font-medium text-gray-900">
                                            {{ plan.parts.description}}
                                        </div>
                                        <div class="absolute right-0 h-px bg-gray-200 -top-px left-6" />
                                    </td>
                                    <td
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        <b class="text-lg">{{ plan.amount }}</b>  Peças</td>
                                    <td
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        {{ plan.buy_date }}</td>
                                    <td
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        R$ {{ plan.priceu }}</td>
                                    <td
                                        class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                        R$ {{ plan.pricet }}</td>
                                    <td
                                        class="border-t border-transparent relative py-3.5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <button type="button"
                                            class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                                            Estoque<span class="sr-only">, {{ plan.id }}</span>
                                        </button>
                                        <div class="absolute left-0 h-px bg-gray-200 -top-px right-6" />
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
    props: ['errors', 'data', 'parts', 'purchase'],

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
