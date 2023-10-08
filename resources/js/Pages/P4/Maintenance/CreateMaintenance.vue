<template>
    <Head title="Nova Manutenção" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">P4 - DTIC/PMSC</h2>
        </template>

        <div class="p-2 py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="grid grid-cols-1 p-4 pt-10 gap-x-8 gap-y-8 md:grid-cols-3">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Entrada Manutenção</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Entrada em equipamentos para manutenção.</p>
                        </div>

                        <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="oil" class="block text-sm font-medium leading-6 text-gray-900">Troca de Óleo</label>
                                        <div class="mt-2">
                                            <select id="oil" name="oil"  v-model="form.oil" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="7000"> Óleo 7.000 KM </option>
                                                <option value="10000"> Óleo 10.000 KM </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Viatura</label>
                                        <div class="mt-2">
                                            <select id="active" name="active"  v-model="form.active" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="0"> Rodando </option>
                                                <option value="1"> Baixada </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="factory_id" class="block text-sm font-medium leading-6 text-gray-900">Oficina</label>
                                        <div class="mt-2">
                                            <select id="factory_id" name="factory_id" v-model="form.factory_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in factorye" :key="option.id" :value="option.id">{{ option.name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="drivers_id" class="block text-sm font-medium leading-6 text-gray-900">Responsável</label>
                                        <div class="mt-2">
                                            <select id="drivers_id" name="drivers_id" v-model="form.drivers_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in driver" :key="option.id" :value="option.id">{{ option.name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição do Serviço</label>
                                        <div class="mt-2">
                                            <textarea v-model="form.description" name="description" id="description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
                                <button type="button" @click="save(form)" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
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
    props: ['errors', 'car', 'factorye', 'driver'],

    data() {
        return {
            editMode: false,
            errors: [],
            form: {
                description: null,
                drivers_id: null,
                factory_id: null,
                oil: null,
                active: null,
                car_id: this.car.id
            },

        }
    },
    methods: {
        reset: function () {
            this.form = {
                description: null,
                drivers_id: null,
                factory_id: null,
                oil: null,
                active: null,
            }
        },
        save: function (data) {
            console.log(data)

            // const payload = {
            //     description: data.description,
            //     drivers_id: data.drivers_id,
            //     factory_id: data.factory_id,
            //     oil: data.oil,
            //     active: data.active,
            //     cars_id: data.car_id
            // };

            this.$inertia.post('/carMain', data)

            // this.reset();
            this.editMode = false;
        },



    },
}
</script>
