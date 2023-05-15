<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Dashboard</h2>
        </template>

        <div class="p-2 py-12">
            <div class="px-4 py-8 bg-white rounded rounded-lg shadow-2xl">
                <div class="grid grid-cols-12 grid-rows-1 gap-3">
                    <div class="col-span-2 p-4 ring-1 ring-red-300 rounded-3xl xl:p-4">
                        <div class="col-span-3 p-4 ring-1 ring-red-300 bg-red-50 rounded-3xl xl:p-4">
                            <h3 class="text-2xl font-bold text-center">Chamado Abertos</h3>
                        </div>
                        <div class="inline">
                            <ul class="grid grid-cols-1">
                                <li v-for="cal in callOpen" :key="cal.id" class="w-full py-2">
                                    <button v-if="cal.status_id === 1" @click="edit(cal), openModal()"
                                        class="w-full px-8 py-2 text-red-500 bg-red-100 border border-red-500 rounded rounded-lg btn">{{
                                            cal.glpi }}</button>
                                    <button v-else-if="cal.status_id === 3" @click="edit(cal), openModal()"
                                        class="w-full px-8 py-2 text-yellow-500 bg-yellow-100 border border-yellow-500 rounded rounded-lg btn">{{
                                            cal.glpi }}</button>
                                    <button v-else @click="edit(cal), openModal()"
                                        class="w-full px-8 py-2 text-indigo-500 bg-indigo-100 border border-indigo-500 rounded rounded-lg btn">{{
                                            cal.glpi }}</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-span-8 p-4 ring-1 ring-gray-400 rounded-3xl xl:p-4">
                        <div class="col-span-3 p-2 ring-1 ring-gray-300 bg-gray-50 rounded-3xl xl:p-2">
                            <h3 class="text-2xl font-bold text-center">Bancada</h3>
                        </div>
                        <div class="flex items-center justify-between pt-3 gap-x-4">
                            <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                <li v-for="person in called" :key="person.id"
                                    class="flex flex-col col-span-1 text-center bg-white border divide-y divide-gray-200 rounded-lg shadow-md border-1">
                                    <div class="flex flex-col flex-1 p-8">
                                        <!-- <img class="flex-shrink-0 w-32 h-32 mx-auto rounded-full" :src="person.imageUrl" alt="" /> -->
                                        <h2 class="mt-6 text-sm font-medium text-gray-900">{{ person.technic.name }}</h2>
                                        <dl class="flex flex-col justify-between flex-grow mt-1">
                                            <dt class="sr-only">Title</dt>
                                            <dd class="text-sm text-gray-500">{{ person.company }}</dd>
                                            <dt class="sr-only">Role</dt>
                                            <dd class="mt-3">
                                                <span
                                                    class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">{{
                                                        person.glpi }}</span>
                                            </dd>
                                            <dd class="pt-2 text-sm font-bold text-gray-500"> * {{ person.service }}</dd>
                                        </dl>
                                    </div>
                                    <div>
                                        <div class="flex -mt-px divide-x divide-gray-200">
                                            <button @click="openModal1()"
                                                class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-semibold text-gray-900 border border-transparent rounded-br-lg gap-x-3">
                                                Laudo
                                            </button>
                                            <!-- <div class="flex flex-1 w-0">
                                                <a
                                                    class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-semibold text-gray-900 border border-transparent rounded-bl-lg gap-x-3">
                                                    Fechar
                                                </a>
                                            </div>
                                            <div class="flex flex-1 w-0 -ml-px"> -->
                                            <!-- <a :href="route('users.edit', police.id)" type="button"  class="p-2 font-medium text-red-600 bg-white border border-gray-200 rounded-md hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2">
                                                        Laudo<span class="sr-only">, {{ police.id }}</span>
                                                </a> -->

                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-span-2 p-4 ring-1 ring-green-300 rounded-3xl xl:p-4">
                        <div class="col-span-3 p-4 ring-1 ring-green-300 bg-emerald-50 rounded-3xl xl:p-4">
                            <h3 class="text-2xl font-bold text-center">Chamados Fechados</h3>
                        </div>
                        <div class="inline">
                            <ul class="grid grid-cols-1">
                                <li class="w-full py-2">
                                    <button
                                        class="w-full px-8 py-2 text-green-500 bg-green-100 border rounded rounded-lg btn border-emerald-500">ID
                                        152282</button>
                                </li>
                                <li class="w-full py-2">
                                    <button
                                        class="w-full px-8 py-2 text-green-500 bg-green-100 border rounded rounded-lg btn border-emerald-500">ID
                                        152283</button>
                                </li>
                                <li class="w-full py-2">
                                    <button
                                        class="w-full px-8 py-2 text-green-500 bg-green-100 border rounded rounded-lg btn border-emerald-500">ID
                                        152232</button>
                                </li>
                                <li class="w-full py-2">
                                    <button
                                        class="w-full px-8 py-2 text-green-500 bg-green-100 border rounded rounded-lg btn border-emerald-500">ID
                                        152215</button>
                                </li>
                                <li class="w-full py-2">
                                    <button
                                        class="w-full px-8 py-2 text-green-500 bg-green-100 border rounded rounded-lg btn border-emerald-500">ID
                                        152275</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Atribuir Técnico -->
        <div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400" v-if="isOpen">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form>
                        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                            <div class="rounded rounded-md ring-1 ring-gray-400">
                                <div class="grid max-w-2xl grid-cols-1 p-2 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                                    <div class="sm:col-span-3">
                                        <label for="status"
                                            class="block text-sm font-medium leading-6 text-gray-900">Técnico</label>
                                        <div class="mt-2">
                                            <select id="technic_id" name="technic_id" v-model="form.technic_id"
                                                class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in technic" :key="option.id" :value="option.id">{{
                                                    option.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="status"
                                            class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                        <div class="mt-2">
                                            <select id="status_id" name="status_id" v-model="form.status_id"
                                                class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in status" :key="option.id" :value="option.id">{{
                                                    option.situation }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button @click="closeModal()" type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                                    <button @click="update(form)" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Atribuir</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Laudo Técnico -->
        <div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400" v-if="isOpen1">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form @submit.prevent>
                        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                            <div class="rounded rounded-md ring-1 ring-gray-400">
                                <div class="px-4 py-6 sm:p-8">
                                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="col-span-full">
                                            <label for="service"
                                                class="block text-sm font-medium leading-6 text-gray-900">Serviços</label>
                                            <div class="mt-2">
                                                <textarea v-model="form.service" name="service" id="service"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                            </div>
                                        </div>

                                        <div>
                                            <button @click.prevent="partsOpen()"
                                                class="relative inline-flex items-center justify-center flex-1 w-0 py-1 text-sm font-semibold text-gray-900 border border-transparent rounded-br-lg gap-x-3">
                                                Peças
                                            </button>
                                        </div>

                                        <div class="sm:col-span-6" v-if="partsOn">

                                        </div>
                                        <div class="sm:col-span-3" v-if="partsOn">
                                                <label for="menu">Escolha um item:</label>
                                                <select id="menu" v-model="selectedItem" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Escolha a peça</option>
                                                    <option v-for="(item, index) in parts" :key="index"
                                                        :value="item.id">{{ item.description }} (PM-{{ item.pm_store !== null ?  item.pm_store.amount : 'N/A'}} | Ilha-{{ item.island_store !== null ?  item.island_store.amount : 'N/A'}})
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="sm:col-span-3" v-if="partsOn">
                                                <label for="quantity">Quantidade:</label>
                                                <input type="number" id="quantity" v-model.number="quantity" min="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <button @click.prevent="addItem">Adicionar Item</button>
                                            </div>

                                        <div class="p-2 rounded rounded-md sm:col-span-6 ring-1 ring-gray-400">
                                            <ul>
                                                <li v-for="(item, index) in itemList" :key="index">{{ item.name }} -
                                                    Quantidade: {{ item.quantity }}</li>
                                            </ul>
                                        </div>

                                        <div class="sm:col-span-3">
                                            <label for="status"
                                                class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                            <div class="mt-2">
                                                <select id="status_id" name="status_id" v-model="form.status_id"
                                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                    <option v-for="option in statusReport" :key="option.id"
                                                        :value="option.id">{{ option.situation }}</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div
                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button @click="closeModal1()" type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                                    <button @click="report(form)" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Atribuir</button>
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
    props: ['errors', 'data', 'status', 'callClose', 'callOpen', 'technic', 'called', 'parts', 'statusReport'],

    data() {
        return {
            editMode: false,
            isOpen: false,
            isOpen1: false,
            partsOn: false,
            loading: false,
            form: {
                technic_id: null,
                status_id: null,

            },
            selectedItem: '',
            quantity: 1,
            // menuItems: [
            //     { id: 1, name: 'Item 1' },
            //     { id: 2, name: 'Item 2' },
            //     { id: 3, name: 'Item 3' },
            // ],
            itemList: [],


        }
    },
    methods: {
        updateItemValue(event) {

            this.selectedItemValue = event.target.value;
        },
        openModal: function () {
            this.isOpen = true;
        },
        openModal1: function () {
            this.isOpen1 = true;
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },
        closeModal1: function () {
            this.isOpen1 = false;
            this.reset();
            this.editMode = false;
        },
        partsOpen: function () {
            this.partsOn = true;
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
                technic_id: a.technic_id,
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
        addItem() {
            const selectedItem = this.parts.find(item => item.id === Number(this.selectedItem));
            if (!selectedItem) {
                return;
            }
            const newItem = {
                name: selectedItem.description,
                quantity: this.quantity,
            };
            this.itemList.push(newItem);
            this.selectedItem = '';
            this.quantity = 1;
        },



    },
}
</script>
