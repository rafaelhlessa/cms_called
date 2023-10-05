<template>
    <Head title="Adicionar de Viatura" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Adicionar de Motorista</h2>
        </template>

        <div class="p-2 py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="grid grid-cols-1 p-4 pt-10 gap-x-8 gap-y-8 md:grid-cols-3">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Cadastro de Motoristas</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Formulário de Cadastro de Motoristas.</p>
                        </div>

                        <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.name" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Setor</label>
                                        <div class="mt-2">
                                            <select id="location" name="location" v-model="form.location" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="CMS"> CMS </option>
                                                <option value="Diretoria"> Diretoria </option>
                                                <option value="INOVA"> INOVA </option>
                                                <option value="P1"> P1 </option>
                                                <option value="P4"> P4 </option>
                                                <option value="Rádio"> Rádio </option>
                                                <option value="Redes"> Redes </option>
                                                <option value="Telefonia"> Telefonia </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="km" class="block text-sm font-medium leading-6 text-gray-900">Telefone</label>
                                        <div class="mt-2">
                                            <vue-mask v-model="form.phone" mask="(99) 9 9999-9999" :raw="false" :options="options" placeholder="(48) 9 9999-9999" autofocus class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </vue-mask>
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
import vueMask from 'vue-jquery-mask';


export default {
    name: "EntranceCars",
    components: {
        AuthenticatedLayout,
        Head,
        vueMask
    },
    props: ['errors'],

    data() {
        return {
            editMode: false,
            errors: [],
            form: {
                name: null,
                location: null,
                phone: '',
            },

        }
    },
    methods: {
        reset: function () {
            this.form = {
                name: null,
                location: null,
                phone: null,
            }
        },
        save: function (data) {
            console.log(data)
            this.$inertia.post('/driver', data)

            // this.reset();
            this.editMode = false;
        },
    },
}
</script>
