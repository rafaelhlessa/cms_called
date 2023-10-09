<template>
    <Head title="Lista de Motoristas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Lista de Motoristas</h2>
        </template>

        <div class="p-2 py-12">
            <div class="px-4 py-8 bg-white rounded-lg shadow-2xl">
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
                                <td class="border-t border-gray-200 hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
                                    <a :href="route('car.edit', plan.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                        </svg>

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
    name: "DriversList",
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
    },

}
</script>
