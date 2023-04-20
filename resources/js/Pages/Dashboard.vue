<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12 p-2">
            <div class="bg-white py-8 px-4 rounded rounded-lg shadow-2xl">
                <div class="grid grid-rows-1 grid-cols-12 gap-3">
                    <div class="col-span-2 ring-1 ring-red-300 rounded-3xl p-4 xl:p-4">
                        <div class="col-span-3 ring-1 ring-red-300 bg-red-50 rounded-3xl p-4 xl:p-4">
                            <h3 class="text-center text-2xl font-bold">Chamado Abertos</h3>
                        </div>
                        <div class="inline">
                            <ul class="grid grid-cols-1">
                                <li v-for="cal in callOpen" :key="cal.id" class="py-2 w-full">
                                    <button v-if="cal.status_id === 1" @click="edit(cal), openModal()"
                                        class="btn bg-red-100 text-red-500 rounded rounded-lg border border-red-500 px-8 py-2 w-full">{{
                                            cal.glpi }}</button>
                                    <button v-else-if="cal.status_id === 3" @click="edit(cal), openModal()"
                                        class="btn bg-yellow-100 text-yellow-500 rounded rounded-lg border border-yellow-500 px-8 py-2 w-full">{{
                                            cal.glpi }}</button>
                                    <button v-else @click="edit(cal), openModal()"
                                        class="btn bg-indigo-100 text-indigo-500 rounded rounded-lg border border-indigo-500 px-8 py-2 w-full">{{
                                            cal.glpi }}</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-span-8 ring-1 ring-gray-400 rounded-3xl p-4 xl:p-4">
                        <div class="col-span-3 ring-1 ring-gray-300 bg-gray-50 rounded-3xl p-2 xl:p-2">
                            <h3 class="text-center text-2xl font-bold">Bancada</h3>
                        </div>
                        <div class="flex items-center justify-between gap-x-4 pt-3">
                            <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                <li v-for="person in called" :key="person.id"
                                    class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg border border-1 bg-white text-center shadow-md">
                                    <div class="flex flex-1 flex-col p-8">
                                        <!-- <img class="mx-auto h-32 w-32 flex-shrink-0 rounded-full" :src="person.imageUrl" alt="" /> -->
                                        <h2 class="mt-6 text-sm font-medium text-gray-900">{{ person.technic.name }}</h2>
                                        <dl class="mt-1 flex flex-grow flex-col justify-between">
                                            <dt class="sr-only">Title</dt>
                                            <dd class="text-sm text-gray-500">{{ person.company }}</dd>
                                            <dt class="sr-only">Role</dt>
                                            <dd class="mt-3">
                                                <span
                                                    class="rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">{{
                                                        person.glpi }}</span>
                                            </dd>
                                            <dd class="text-sm text-gray-500 pt-2 font-bold"> * {{ person.service }}</dd>
                                        </dl>
                                    </div>
                                    <div>
                                        <div class="-mt-px flex divide-x divide-gray-200">
                                            <div class="flex w-0 flex-1">
                                                <a
                                                    class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                    Fechar
                                                </a>
                                            </div>
                                            <div class="-ml-px flex w-0 flex-1">
                                                <!-- <a :href="route('users.edit', police.id)" type="button"  class="rounded-md border border-gray-200 p-2 bg-white font-medium text-red-600 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2">
                                                        Laudo<span class="sr-only">, {{ police.id }}</span>
                                        </a> -->
                                                <a href="#"
                                                    class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                    Laudo
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-span-2 ring-1 ring-green-300 rounded-3xl p-4 xl:p-4">
                        <div class="col-span-3 ring-1 ring-green-300 bg-emerald-50 rounded-3xl p-4 xl:p-4">
                            <h3 class="text-center text-2xl font-bold">Chamados Fechados</h3>
                        </div>
                        <div class="inline">
                            <ul class="grid grid-cols-1">
                                <li class="py-2 w-full">
                                    <button
                                        class="btn bg-green-100 text-green-500 rounded rounded-lg border border-emerald-500 px-8 py-2 w-full">ID
                                        152282</button>
                                </li>
                                <li class="py-2 w-full">
                                    <button
                                        class="btn bg-green-100 text-green-500 rounded rounded-lg border border-emerald-500 px-8 py-2 w-full">ID
                                        152283</button>
                                </li>
                                <li class="py-2 w-full">
                                    <button
                                        class="btn bg-green-100 text-green-500 rounded rounded-lg border border-emerald-500 px-8 py-2 w-full">ID
                                        152232</button>
                                </li>
                                <li class="py-2 w-full">
                                    <button
                                        class="btn bg-green-100 text-green-500 rounded rounded-lg border border-emerald-500 px-8 py-2 w-full">ID
                                        152215</button>
                                </li>
                                <li class="py-2 w-full">
                                    <button
                                        class="btn bg-green-100 text-green-500 rounded rounded-lg border border-emerald-500 px-8 py-2 w-full">ID
                                        152275</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Atribuir Técnico -->
        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="ring-1 ring-gray-400 rounded rounded-md">
                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 p-2 md:col-span-2">
                                    <div class="sm:col-span-3">
                                        <label for="country"
                                            class="block text-sm font-medium leading-6 text-gray-900">Técnico</label>
                                        <div class="mt-2">
                                            <select id="technic_id" name="technic_id" v-model="form.technic_id" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in technic" :key="option.id" :value="option.id">{{ option.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="country"
                                            class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                        <div class="mt-2">
                                            <select id="status_id" name="status_id" v-model="form.status_id" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in status" :key="option.id" :value="option.id">{{ option.situation }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button @click="closeModal()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                                    <button @click="update(form)" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Atribuir</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
        Head,
    },
    props: ['errors', 'data', 'status', 'callClose', 'callOpen', 'technic', 'called'],

    data() {
        return {
            editMode: false,
            isOpen: false,
            loading: false,
            form: {
                technic_id: null,
                status_id: null,
            },
        }
    },
    methods: {
        openModal: function () {
            this.isOpen = true;
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },
        reset: function () {
            this.form = {
                status_id: null,
                technic_id: null,
            }
        },
        edit: function (data) {
            this.form = Object.assign(data);
            this.editMode = true;
            this.openModal();
        },
        update: function (a) {
            // Validate the status_id and technic_id fields
            if (!a.status_id || !a.technic_id) {
                console.error('status_id and technic_id are required.');
                return;
            }

            console.log(a);
            a._method = 'PUT';

            // Save the status_id and technic_id fields
            const payload = {
                id: a.id,
                status_id: a.status_id,
                technic_id: a.technic_id
            };

            this.$inertia.put('/call/' + a.id, payload);
            this.reset();
            this.closeModal();
            location.reload()
            // .then(() => {

            //     })
            //     .catch((error) => {
            //     console.error(error);
            //     });
        },

    },
}
</script>
