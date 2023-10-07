<template>
    <Head title="Adicionar de Viatura" />

    <div class="bg-gray-600">
        <div class="p-2 py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="grid grid-cols-1 p-4 pt-10 gap-x-8 gap-y-8 md:grid-cols-3">
                        <div class="px-4 sm:px-0">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Uso de Viaturas</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Formulário de Uso de Viaturas.</p>
                        </div>

                        <form v-if="car.used === 0" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="plate" class="block text-sm font-medium leading-6 text-gray-900">Placa</label>
                                        <div class="mt-2">
                                            <input :value="car.plate" disabled type="text" name="plate" id="plate" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="brandmodel" class="block text-sm font-medium leading-6 text-gray-900">Marca / Modelo</label>
                                        <div class="mt-2">
                                            <input :value="car.brandmodel" disabled type="text" name="brandmodel" id="brandmodel" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="km" class="block text-sm font-medium leading-6 text-gray-900">Km Inicial</label>
                                        <div class="mt-2">
                                            <input :value="car.km" disabled type="text" name="km" id="km" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="fuel" class="block text-sm font-medium leading-6 text-gray-900">Combustível</label>
                                        <div class="mt-2">
                                            <div v-on="getBarColor" class="h-5 bg-gray-300 rounded-full" :style="{ width: car.fuel + '%', backgroundColor: getBarColor(car.fuel)}">
                                                <b class="text-center text-gray-50 mx-2">{{ car.fuel }}%</b>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="fuel" class="block text-sm font-medium leading-6 text-gray-900">Motorista</label>
                                        <div class="mt-2">
                                            <select id="drivers_id" name="drivers_id" v-model="form.drivers_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option v-for="option in driver" :key="option.id" :value="option.id">{{ option.name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
                                <button type="button" @click="save(form)" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Usar VTR</button>
                            </div>
                        </form>
                        <form v-if="car.used === 1" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="plate" class="block text-sm font-medium leading-6 text-gray-900">Placa</label>
                                        <div class="mt-2">
                                            <input :value="car.plate" disabled type="text" name="plate" id="plate" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="brandmodel" class="block text-sm font-medium leading-6 text-gray-900">Marca / Modelo</label>
                                        <div class="mt-2">
                                            <input :value="car.brandmodel" disabled type="text" name="brandmodel" id="brandmodel" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="km" class="block text-sm font-medium leading-6 text-gray-900">Km</label>
                                        <div class="mt-2">
                                            <input v-model="form.kmend" type="text" name="km" id="km" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="fuel" class="block text-sm font-medium leading-6 text-gray-900">Combustível</label>
                                        <div class="mt-2">
                                            <select id="fuel" name="fuel"  v-model="form.fuel" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="15"> Reserva </option>
                                                <option value="25"> 1/4 </option>
                                                <option value="50"> 1/2 </option>
                                                <option value="75"> 3/4 </option>
                                                <option value="100"> Cheio </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
                                <button type="button" @click="update(form)" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Devolver VTR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import vueMask from 'vue-jquery-mask';
import drivers from "@/Pages/P4/Drivers.vue";


export default {
    name: "EntranceCars",
    computed: {
        drivers() {
            return drivers
        }
    },
    components: {
        AuthenticatedLayout,
        Head,
        vueMask
    },
    props: ['error', 'car', 'driver', 'usedvtr'],

    data() {
        return {
            editMode: false,
            error: [],
            form: {
                vtr_id: '',
                kmstart: '',
                kmend: null,
                fuel: null,
                used: null,
                drivers_id: null,
            },

        }
    },
    methods: {
        reset: function () {
            this.form = {
                plate: null,
                brandmodel: null,
                km: null,
                fuel: null,
                used: null,
                drivers_id: null,
            }
        },
        save: function (data) {
            console.log(data)

            const payload = {
                vtr_id: this.car.id,
                kmstart: this.car.km,
                fuel: this.car.fuel,
                drivers_id: data.drivers_id
            };

            this.$inertia.post('/usevtrs', payload)

            this.reset();
            this.editMode = false;
        },
        edit: function (data) {
            this.form = Object.assign(data);
            this.editMode = true;
        },
        update: function (a) {
            a._method = 'PUT';

            // Save the status_id and technic_id fields
            const payload = {
                id: this.usedvtr.id,
                vtr_id: this.car.id,
                kmstart: this.car.km,
                kmend: a.kmend,
                fuel: a.fuel,
            };

            this.$inertia.put('/usevtrs/' + a.id, payload);
            this.reset();
            // location.reload()

        },
        getBarColor(value) {
            if (value === 100) {
                return '#04B404'; // Change to your desired color class
            } else if (value === 75) {
                return '#82FA58'; // Change to your desired color class
            } else if (value === 50) {
                return '#F7FE2E'; // Change to your desired color class
            } else if (value === 25) {
                return '#FE9A2E'; // Change to your desired color class
            } else {
                return '#DF0101'; // Change to your desired color class
            }
        }
    },
}
</script>
