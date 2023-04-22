<template>
    <Head title="Adicionar de Peças" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Adicionar de Peças</h2>
        </template>

        <div class="py-12 p-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3 p-4">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Entrada Manutenção</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Entrada em equipamentos para manutenção.</p>
                    </div>

                    <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                                <div class="mt-2">
                                    <input type="text" v-model="form.description" name="description" id="description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                                </div>

                                <div class="sm:col-span-3">
                                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Telefone</label>
                                <div class="mt-2">
                                    <input type="text" v-model="form.phone" name="phone" id="phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                                </div>

                                <div class="sm:col-span-3">
                                <label for="glpi" class="block text-sm font-medium leading-6 text-gray-900">Nº Chamado GLPI</label>
                                <div class="mt-2">
                                    <input type="text" v-model="form.glpi" id="glpi" name="glpi" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                                </div>

                                <div class="sm:col-span-3">
                                <label for="pim" class="block text-sm font-medium leading-6 text-gray-900">Nº do PIM</label>
                                <div class="mt-2">
                                    <input type="text" v-model="form.pim" id="pim" name="pim" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                                </div>

                                <div class="col-span-full">
                                <label for="service" class="block text-sm font-medium leading-6 text-gray-900">Serviços</label>
                                <div class="mt-2">
                                    <textarea v-model="form.service" name="service" id="service" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
                        <button type="button" @click="save(form)" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
                        </div>
                    </form>
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
    props: ['errors', 'data', 'partsType', 'equipaments'],

    data() {
        return {
            editMode: false,
            errors: [],
            form: {
                description: null,
                partsType_id: null,
                equipaments_id: null,
            },

        }
    },
    methods: {
        reset: function () {
            this.form = {
                description: null,
                partsType_id: null,
                equipaments_id: null,
            }
        },
        save: function (data) {
            console.log(data)
            this.$inertia.post('/part', data)

            // this.reset();
            this.editMode = false;
        },


    },
}
</script>
