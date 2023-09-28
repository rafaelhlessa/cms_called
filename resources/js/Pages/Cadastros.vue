<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="p-40 py-6">
            <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow lg:grid-cols-3 md:divide-x md:divide-y-0 border border-gray-300">
                <div class="px-4 py-5 sm:p-6 bg-green-200">
                    <dt class="text-base font-normal text-gray-900">Chamados Encerrados</dt>
                    <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                        <div class="flex items-baseline text-xl font-semibold text-gray-600">
                            {{currentMonth}}
                            <span class="ml-2 text-2xl font-semi-bold rounded-lg border border-gray-400 py-1 px-1 bg-gray-200 text-gray-600">{{ currentMonthCount }} </span>
                            <span class="ml-2 text-sm font-medium text-gray-500">{{previousMonth}} </span>
                            <span class="ml-2 text-sm font-semi-bold rounded-lg border border-gray-400 py-1 px-1 bg-gray-200 text-gray-500">{{previousMonthCount}} </span>
                        </div>

                        <div v-if="currentMonthCount > previousMonthCount" class="bg-green-100 text-green-800 inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0']">
                            <ArrowUpIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
                            +{{monthDifference}}
                        </div>
                        <div v-else class="bg-blue-100 text-blue-800 inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0']">
                            <ArrowDownIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
                            {{monthDifference}}
                        </div>
                    </dd>
                </div>

                <div class="px-4 py-5 sm:p-6 bg-red-300">
                    <dt class="text-base font-normal text-gray-900">Chamados Abertos</dt>
                    <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                        <div class="flex items-baseline text-xl font-semi-bold text-gray-600">
                            {{currentMonth}}
                            <span class="ml-2 text-2xl font-semi-bold rounded-lg border border-gray-400 py-1 px-1 bg-gray-200 text-gray-600">{{ currentMonthCountOpen }} </span>
                            <span class="ml-2 text-sm font-medium text-gray-500">{{previousMonth}} </span>
                            <span class="ml-2 text-sm font-semi-bold rounded-lg border border-gray-400 py-1 px-1 bg-gray-200 text-gray-500">{{previousMonthCountOpen}} </span>
                        </div>

                        <div v-if="currentMonthCountOpen > previousMonthCountOpen" class="bg-green-100 text-green-800 inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0']">
                            <ArrowUpIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
                            +{{monthDifferenceOpen}}
                        </div>
                        <div v-else class="bg-blue-100 text-blue-800 inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0']">
                            <ArrowDownIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-blue-500" aria-hidden="true" />
                            {{monthDifferenceOpen}}
                        </div>
                    </dd>
                </div>

                <div class="px-4 py-5 sm:p-6 bg-amber-500">
                    <dt class="text-base font-normal text-gray-900">Chamados Pendentes</dt>
                    <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                        <div class="flex items-baseline text-xl font-semi-bold text-gray-600">
                            {{currentMonth}}
                            <span class="ml-2 text-2xl font-semi-bold rounded-lg border border-gray-400 py-1 px-1 bg-gray-200 text-gray-600">{{ currentMonthCountPend }} </span>
                            <span class="ml-2 text-sm font-medium text-gray-500">{{previousMonth}} </span>
                            <span class="ml-2 text-sm font-semi-bold rounded-lg border border-gray-400 py-1 px-1 bg-gray-200 text-gray-500">{{previousMonthCountPend}} </span>
                        </div>

                        <div v-if="currentMonthCountPend > previousMonthCountPend" class="bg-green-100 text-green-800 inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0']">
                            <ArrowUpIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
                            +{{monthDifferencePend}}
                        </div>
                        <div v-else class="bg-blue-100 text-blue-800 inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0']">
                            <ArrowDownIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
                            {{monthDifferencePend}}
                        </div>
                    </dd>
                </div>
            </dl>
        </div>

        <div class="p-2 py-6">
            <div class="px-4 py-8 bg-white rounded-lg shadow-2xl">
                <div class="grid grid-cols-12 grid-rows-1 gap-3">
                    <div class="col-span-2 p-4 ring-1 ring-red-300 rounded-3xl xl:p-4">
                        <div class="col-span-3 p-4 ring-1 ring-red-300 bg-red-50 rounded-3xl xl:p-4">
                            <h3 class="text-2xl font-bold text-center">Chamados Abertos</h3>
                        </div>

                        <div class="inline">
                            <!--<ul v-for="cal in evenNumbers" :key="cal.name" class="grid grid-cols-1">-->
                            {{call}}
                            <ul v-for="cal in evenNumbers" :key="cal.name" class="grid grid-cols-1">
                                <li  v-if="cal.status === 2" @click="creat(cal), edit(cal), openModal()" class="w-full py-2">
                                    <button
                                        class="w-full px-8 py-2 text-red-500 bg-red-100 border border-red-500 rounded-lg btn">
                                        {{cal.id }} - {{ cal.name }}
                                    </button>
                                </li>
                                <li  v-if="cal.status === 4" @click="creat(cal), edit(cal), openModal()" class="w-full py-2">
                                    <button
                                        class="w-full px-8 py-2 text-orange-500 bg-orange-100 border border-orange-500 rounded-lg btn">
                                        {{cal.id }} - {{ cal.name }}
                                    </button>
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
                                <li v-for="person in called" :key="person.id" class="flex flex-col col-span-1 text-center bg-white border divide-y divide-gray-200 rounded-lg shadow-md border-1">
                                    <div class="flex flex-col flex-1 p-8">
                                        <h2 class="mt-6 text-sm font-medium text-gray-900">{{ person.technic.name }}</h2>
                                        <dl class="flex flex-col justify-between flex-grow mt-1">
                                            <dt class="sr-only">Title</dt>
                                            <dd class="text-sm text-gray-500">{{ person.company }}</dd>
                                            <dt class="sr-only">Role</dt>
                                            <dd class="mt-3">
                                                <span
                                                    class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Chamado - {{person.glpi }}
                                                </span>
                                            </dd>
                                            <dd class="mt-3">
                                                <span
                                                    class="px-2 py-1 text-xs font-medium text-gray-800 bg-gray-100 rounded-full"> {{ shortName(person.name)}}
                                                </span>
                                            </dd>
                                            <dd class="pt-2 text-sm text-gray-500"> <b>Problema:</b> {{ person.service }}</dd>
                                        </dl>
                                    </div>
                                    <div>
                                        <div class="flex -mt-px divide-x divide-gray-200">
                                            <div class="flex flex-1 w-0">
                                                <button @click="edit1(person), openModal1()"
                                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-semibold text-gray-900 border border-transparent rounded-br-lg gap-x-3">
                                                    Ver
                                                </button>
                                            </div>
                                            <div class="flex flex-1 w-0">
                                                <button @click="closeCall(person)"
                                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-semibold text-gray-900 border border-transparent rounded-br-lg gap-x-3">
                                                    Fechar
                                                </button>
                                            </div>
<!--                                            <div class="flex flex-1 w-0 -ml-px">-->
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
                            <ul v-for="cal in evenReady" :key="cal.name" class="grid grid-cols-1">
                                <li v-if="cal.status === 6" class="w-full py-2">
                                    <button class="w-full px-8 py-2 text-green-500 bg-green-100 border rounded-lg btn border-emerald-500">
                                        {{ cal.id }} - {{ cal.name }}</button>
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
                            <div class="rounded-md ring-1 ring-gray-400">
                                <div class="grid max-w-2xl grid-cols-1 p-2 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                                    <div class="sm:col-span-3">
                                        <label for="status"
                                               class="block text-sm font-medium leading-6 text-gray-900">Técnico</label>
                                        <div class="mt-2">
                                            <select id="technic_id" name="technic_id" v-model="form.technic_id"
                                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in technic" :key="option.id" :value="option.id">
                                                    {{ option.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="status"
                                               class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                        <div class="mt-2">
                                            <select id="status_id" name="status_id" v-model="form.status_id"
                                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in status" :key="option.id" :value="option.id">
                                                    {{ option.situation }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button @click="closeModal()" type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                                    <button @click="update(form), checkForm()" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Atribuir</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Laudo Técnico -->
<!--        <div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400" v-if="isOpen1">-->
<!--            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">-->

<!--                <div class="fixed inset-0 transition-opacity">-->
<!--                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>-->
<!--                </div>-->
<!--                &lt;!&ndash; This element is to trick the browser into centering the modal contents. &ndash;&gt;-->
<!--                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​-->
<!--                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"-->
<!--                     role="dialog" aria-modal="true" aria-labelledby="modal-headline">-->
<!--                    <form @submit.prevent>-->
<!--                        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">-->
<!--                            <div class="rounded rounded-md ring-1 ring-gray-400">-->
<!--                                <div class="px-4 py-6 sm:p-8">-->
<!--                                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">-->
<!--                                        <div class="col-span-full">-->
<!--                                            <label for="solution"-->
<!--                                                   class="block text-sm font-medium leading-6 text-gray-900">Serviços</label>-->
<!--                                            <div class="mt-2">-->
<!--                                                <textarea v-model="form.solution" name="solution" id="solution"-->
<!--                                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />-->
<!--                                            </div>-->
<!--                                        </div>-->

<!--                                        <div class="pb-4">-->
<!--                                            <button @click.prevent="partsOpen()"-->
<!--                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">-->
<!--                                                Peças-->
<!--                                            </button>-->
<!--                                        </div>-->

<!--                                        <div class="sm:col-span-6" v-if="partsOn">-->

<!--                                        </div>-->
<!--                                        <div class="sm:col-span-3" v-if="partsOn">-->
<!--                                            <label for="menu">Escolha um item:</label>-->
<!--                                            <select id="menu" v-model="selectedItem"-->
<!--                                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">-->
<!--                                                <option value="">Escolha a peça</option>-->
<!--                                                <option v-for="(item, index) in parts" :key="index" :value="item.id">{{ item.description }}-->
<!--                                                    (PM-{{ item.pm_store !== null ? item.pm_store.amount : 'N/A' }} | Ilha-{{ item.island_store !== null ? item.island_store.amount : 'N/A' }})-->
<!--                                                </option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                        <div class="sm:col-span-3" v-if="partsOn">-->
<!--                                            <label for="quantity">Quantidade:</label>-->
<!--                                            <input type="number" id="quantity" v-model.number="quantity" min="1"-->
<!--                                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">-->
<!--                                            <button @click.prevent="addItem">Adicionar Item</button>-->
<!--                                        </div>-->

<!--                                        <div id="target" class="sm:col-span-6" v-if="partsOn">-->
<!--                                            <ul>-->
<!--                                                <div v-if="partsOn"-->
<!--                                                     class="p-2 rounded rounded-md sm:col-span-6 ring-1 ring-gray-400">-->
<!--                                                    <li v-for="(item, index) in itemList" :key="index">-->
<!--                                                        {{ item.name }} - Quantidade: {{ item.quantity }}-->
<!--                                                    </li>-->
<!--                                                </div>-->
<!--                                            </ul>-->
<!--                                        </div>-->

<!--                                        <div class="col-span-full">-->
<!--                                            <label for="status"-->
<!--                                                   class="block text-sm font-medium leading-6 text-gray-900">Status</label>-->
<!--                                            <div class="mt-2">-->
<!--                                                <select id="status_id" name="status_id" v-model="form.status_id"-->
<!--                                                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">-->
<!--                                                    <option v-for="option in statusReport" :key="option.id"-->
<!--                                                            :value="option.id">{{ option.situation }}</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->

<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div-->
<!--                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">-->
<!--                                    <button @click="closeModal1()" type="button"-->
<!--                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>-->
<!--                                    <button @click="report(form)" type="button"-->
<!--                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Atribuir</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!-- Modal Chamado -->
        <div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400" v-if="isOpen1">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-xl sm:my-4 sm:align-middle sm:max-w-lg sm:w-full"
                     role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div>
                        <div class="flex flex-col flex-1 p-4">
                            <div class="flex flex-col items-start gap-x-8 gap-y-6 rounded-3xl p-4 ring-1 ring-gray-900/10 sm:gap-y-10 sm:p-10 lg:col-span-2 lg:flex-row lg:items-center">
                                <div class="lg:min-w-0 lg:flex-1">
                                    <h2 class="text-lg font-semibold leading-8 tracking-tight text-indigo-600">Chamado - ID {{callItem.glpi}}</h2>
                                    <hr>
                                    <p class="text-lg font-semibold leading-8 tracking-tight text-gray-600">{{shortName(callItem.name)}}</p>
                                    <p class="mt-1 text-base leading-7 text-gray-600">{{ callItem.technic.name }}</p>
                                    <p class="mt-1 text-base leading-7 text-gray-600">{{ callItem.service }}</p>
                                    <hr>
                                    <button @click="closeModal1()" type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Sair
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ArrowUpIcon, ArrowDownIcon, CheckIcon} from "heroicons-vue3/solid";


export default {
    name: "EntranceCreate",
    components: {
        AuthenticatedLayout,
        Head,
        ArrowUpIcon,
        ArrowDownIcon,
        CheckIcon
    },
    props: ['data', 'status', 'callClose', 'callOpen', 'technic', 'called', 'call', 'parts', 'statusReport'],

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
                service: null,
                solution: null,
                itemList: [],
            },
            callSave: [],
            callItem: '',
            selectedItem: '',
            quantity: 1,
            itemList: [],
            errors: [],
            currentMonthItems: [],
            count: 0,
            previousMonthCount: 0,
            currentMonthCount: 0,
            monthDifference: 0,
            currentMonth: '',
            previousMonth: '',
            previousMonthCountOpen: 0,
            currentMonthCountOpen: 0,
            monthDifferenceOpen: 0,
            previousMonthCountPend: 0,
            currentMonthCountPend: 0,
            monthDifferencePend: 0,
            // currentMonthOpen: '',
            // previousMonth: '',
        }
    },
    methods: {
        // updateItemValue(event) {
        //     this.selectedItemValue = event.target.value;
        // },
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
            this.clear();
            this.partsOn = false;
        },
        // partsOpen: function () {
        //     this.partsOn = true;
        // },
        reset: function () {
            this.form = {
                status_id: null,
                technic_id: null,
                service: null,
                itemList: [],
            }
        },
        clear: function () {
            let target = document.getElementById("target");

            target.innerText = "";
            this.itemList.splice(0)
        },
        create: function (data) {
            this.callSave = Object.assign(data);
        },
        edit: function (data) {
            this.form = Object.assign(data);
            this.editMode = true;
            this.openModal();
        },
        checkForm: function (a) {
            console.log(a)
            if (this.form.status_id && this.form.technic_id) {
                return true;
            }

            this.errors = [];

            if (!this.form.status_id) {
                this.errors.push('O Status é obrigatório.');
            }
            if (!this.form.technic_id) {
                this.errors.push('O Técnico é obrigatório.');
            }

        },
        creat: function (data) {
            this.$inertia.post('/cad', data)
        },
        update: function (a) {
            this.checkForm(a);
            // Validate the status_id and technic_id fields
            if (!this.form.status_id || !a.technic_id) {
                console.error('status_id and technic_id are required.');
                return;
            }

            // console.log(a);
            a._method = 'PUT';

            //console.log(a.id)

            // Save the status_id and technic_id fields
            const payload = {
                glpi: a.id,
                status_id: a.status_id,
                technic_id: a.technic_id,
            };

            this.$inertia.put('/call/' + a.id, payload);
            this.reset();
            this.closeModal();
            location.reload()

        },
        addItem() {
            const selectedItem = this.parts.find(item => item.id === Number(this.selectedItem));
            if (!selectedItem) {
                return;
            }
            const newItem = {
                id: selectedItem.id,
                name: selectedItem.description,
                quantity: this.quantity,
            };
            this.itemList.push(newItem);
            this.form.itemList.push(newItem);
            this.selectedItem = '';
            this.quantity = 1;
        },
        edit1: function (data) {
            this.callItem = Object.assign(data);
            this.form = Object.assign(data);
            this.editMode = true;
            this.openModal1();
        },
        report: function (e) {
            console.log(e)
            e._method = 'POST';

            // Save the status_id and technic_id fields
            const payload = {
                called_id: e.id,
                status_id: e.status_id,
                technic_id: e.technic_id,
                solution: e.solution,
                item: this.itemList,
            };

            this.$inertia.post('/reportCall/', payload);
            this.reset();
            this.closeModal1();
            // location.reload()
        },
        shortName(name) {
            // Check if name contains "Maintenance |"
            if (name.includes("Manutenção |")) {
                // Split the name by "Maintenance |"
                const parts = name.split("Manutenção |");

                // Return the second part (index 1)
                return parts[1].trim(); // trim to remove any leading/trailing spaces
            }

            // If "Maintenance |" is not found, return the original name
            return name;
        },
        closeCall: function(c) {
            console.log(c)
            c._method = 'PUT';

            // Save the status_id and technic_id fields
            const payload = {
                glpi: c.id,
                status_id: 6,
                technic_id: c.technic_id,
                close: 1
            };

            this.$inertia.put('/call/' + c.id, payload);
            location.reload()

        }


    },
    computed: {
        evenNumbers: function () {
            try{
            // Create a set of 'chamado' IDs for faster lookup
            const chamadoIds = new Set(this.called.map(i => i.id));

            const chamado = new Set(this.call.map((i) => ({
                'name': i[1],
                'id': i[2],
                'group': i[8],
                'status': i[12],
                'opendate': i[15],
                'closedate': i[16],
                'problem': i[21],
            })));

            const filteredItems = [];

               // chamado.forEach(item => {
               //     if (item.name.startsWith("Manutenção") &&
               //         (item.closedate === null || item.closedate === ""))  {
               //         filteredItems.push(item);
               //     }
               // });
            chamado.forEach(item => {
                if (item.group === 'Manutenção' && (item.status <= 2) )  {
                    filteredItems.push(item);
                }
            });

            // Filter out items that have the same ID as in 'chamado'
            const resul = filteredItems.filter(item => !chamadoIds.has(item.id));
            console.log(resul)
            return resul.sort(function (a, b) {
                // console.log(b.id)
                return b.id - a.id;
            });
            } catch (error) {
                // Handle the exception here
                console.error('An error occurred:', error);
                // You can choose to return a default value or handle the error in a way that makes sense for your application.
                return [];
            }

        },
        evenReady: function () {
            // Create a set of 'chamado' IDs for faster lookup
            const chamadoIds = new Set(this.called.map(i => i.id));

            const chamado = new Set(this.call.map((i) => ({
                'name': i[1],
                'id': i[2],
                'group': i[8],
                'status': i[12],
                'opendate': i[15],
                'closedate': i[16],
                'problem': i[21],
            })));

            const filteredItems = [];

            chamado.forEach(item => {
                if (item.name.startsWith("Manutenção") &&
                    (item.closedate !== null || item.closedate !== ""))  {
                    filteredItems.push(item);
                }
            });

            // Filter out items that have the same ID as in 'chamado'
            const resul = filteredItems.filter(item => !chamadoIds.has(item.id));
            // console.log(resul)
            return resul.sort(function (a, b) {
                // console.log(b.id)
                return b.id - a.id;
            });

        },
        filterItemsByCurrentMonth: function () {
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth() + 1; // Months are 0-based, so add 1 to get the current month.
            const currentYear = currentDate.getFullYear();

            const chamadoIds = new Set(this.called.map(i => i.id));

            const chamado = new Set(this.call.map((i) => ({
                'name': i[1],
                'id': i[2],
                'group': i[8],
                'status': i[12],
                'opendate': i[15],
                'closedate': i[16],
                'problem': i[21],
            })));

            // Filter 'this.call' array based on conditions
            // const filteredItems = this.call.filter(item => {
            //     //return item.name.startsWith("Manutenção");
            //     return item.name;
            // });

            const filteredItems = [];

            chamado.forEach(item => {
                if (item.name.startsWith("Manutenção") &&
                    (item.closedate === null || item.closedate === ""))  {
                    filteredItems.push(item);
                }
            });

            // Filter out items that have the same ID as in 'chamado'
            const result = filteredItems.filter(item => !chamadoIds.has(item.id));

            this.count = result.filter((record) => {
                const recordDate = new Date(record.closedate);
                return (
                    recordDate.getMonth() + 1 === currentMonth &&
                    recordDate.getFullYear() === currentYear
                );
            }).length;

        },
        calculateCounts: function() {
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth() + 1; // Months are 0-indexed
            const currentYear = currentDate.getFullYear();

            const previousMonth = currentMonth === 1 ? 12 : currentMonth - 1;
            const previousYear = currentMonth === 1 ? currentYear - 1 : currentYear;

            const chamadoIds = new Set(this.call.map(i => i.id));

            const chamado = new Set(this.call.map((i) => ({
                'name': i[1],
                'id': i[2],
                'group': i[8],
                'status': i[12],
                'opendate': i[15],
                'closedate': i[16],
                'problem': i[21],
            })));

            const filteredItems = [];

            chamado.forEach(item => {
                const itemDate = new Date(item.closedate);
                if (item.name.startsWith("Manutenção") &&
                    (item.closedate !== null || item.closedate !== "") &&
                    (item.status > 4) &&
                    (item.status < 7)) {
                    filteredItems.push(item);
                }
            });

            const filteredItemsOpen = [];

            chamado.forEach(item => {
                const openDate = new Date(item.opendate);
                if (item.name.startsWith("Manutenção")) {
                    filteredItemsOpen.push(item);
                }
            });

            const filteredItemsPend = [];

            chamado.forEach(item => {
                if (item.name.startsWith("Manutenção") &&
                    (item.status === 4)){
                    filteredItemsPend.push(item);
                }
            });

            const currentMonthRecords = filteredItems.filter((record) => {
                const recordDate = new Date(record.closedate);
                return (
                    recordDate.getMonth() + 1 === currentMonth &&
                    recordDate.getFullYear() === currentYear
                );
            });

            const currentMonthRecordsOpen = filteredItemsOpen.filter((record) => {
                const openDate = new Date(record.opendate);
                return (
                    openDate.getMonth() + 1 === currentMonth &&
                    openDate.getFullYear() === currentYear
                );
            });


            const currentMonthRecordsPend = filteredItemsPend.filter((record) => {
                const pendDate = new Date(record.opendate);
                return (
                    pendDate.getMonth() + 1 === currentMonth &&
                    pendDate.getFullYear() === currentYear
                );
            });

            const previousMonthRecords = filteredItems.filter((record) => {
                const recordDate = new Date(record.closedate);
                return (
                    recordDate.getMonth() + 1 === previousMonth &&
                    recordDate.getFullYear() === previousYear
                );
            });

            const previousMonthRecordsOpen = filteredItemsOpen.filter((record) => {
                const openDate = new Date(record.opendate);
                return (
                    openDate.getMonth() + 1 === previousMonth &&
                    openDate.getFullYear() === previousYear
                );
            });

            const previousMonthRecordsPend = filteredItemsPend.filter((record) => {
                const pendDate = new Date(record.opendate);
                return (
                    pendDate.getMonth() + 1 === previousMonth &&
                    pendDate.getFullYear() === previousYear
                );
            });

            this.currentMonthCount = currentMonthRecords.length;
            this.previousMonthCount = previousMonthRecords.length;
            this.monthDifference = this.currentMonthCount - this.previousMonthCount;

            this.currentMonthCountOpen = currentMonthRecordsOpen.length;
            this.previousMonthCountOpen = previousMonthRecordsOpen.length;
            this.monthDifferenceOpen = this.currentMonthCountOpen - this.previousMonthCountOpen;

            this.currentMonthCountPend = currentMonthRecordsPend.length;
            this.previousMonthCountPend = previousMonthRecordsPend.length;
            this.monthDifferencePend = this.currentMonthCountPend - this.previousMonthCountPend;
        },
        updateMonths: function () {
            const currentDate = new Date();
            const currentMonthIndex = currentDate.getMonth();

            // Create an array of month names
            const monthNames = [
                'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro',
            ];

            // Set current month name
            this.currentMonth = monthNames[currentMonthIndex];
            console.log(this.currentMonth)

            // Calculate previous month
            const previousMonthIndex = (currentMonthIndex - 1 + 12) % 12;
            this.previousMonth = monthNames[previousMonthIndex];
        },

    },


}
</script>
