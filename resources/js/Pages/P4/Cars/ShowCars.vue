<template>
    <Head title="Viatura" + car.brandmodel />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ car.brandmodel }} - {{car.plate}}</h2>
        </template>

        <div class="flex justify-center p-14 py-12">
            <div class="px-4 py-8 bg-white rounded-lg shadow-2xl">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-6 sm:px-6 sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Informações Viatura</h3>
                        </div>
                        <div class="mt-4 sm:ml-8 sm:mt-0">
                            <a :href="route('carsMaint', car.id)" class="block w-full px-3 py-2 text-sm font-semibold text-center text-white bg-gray-600 rounded-md shadow-sm outline-neutral-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75zM4.117 19.125a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008z" clip-rule="evenodd" />
                            </svg>Nova Manutenção</a>
                        </div>
                    </div>
                    <div class="border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="text-sm font-medium text-gray-900">{{car.brandmodel}}</div>
                                <div class="text-sm font-medium text-gray-900">{{car.plate}}</div>
                                <div v-if="car.km < car.kmoil" class="text-sm font-medium text-gray-900">Trocar Óleo com {{car.kmoil}} Km.</div>
                                <div v-else class="text-md bold font-medium text-gray-700">Passou {{car.km - car.kmoil}} Km da troca.</div>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">
                                    <label>KM</label>
                                    <p class="text-gray-700">{{car.km}}</p>
                                </dt>
                                <dd class="mt-1 text-sm leading-4 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <label>Combustível</label>
                                    <div v-on="getBarColor" class="h-5 bg-gray-300 rounded-full" :style="{ width: car.fuel + '%', backgroundColor: getBarColor(car.fuel)}">
                                        <b class="text-center text-gray-50 mx-2">{{ car.fuel }}%</b>
                                    </div>
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">
                                    <b v-if="car.used === 0" class="px-3 py-3 sm:p-1 bg-green-300 rounded-lg rounded:bg-neutral-800">Livre</b>
                                    <b v-else class="px-3 py-3 sm:p-1 bg-red-300 rounded-lg rounded:bg-neutral-800">Em Uso</b>
                                </dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <b v-if="car.used === 0" class="px-3 py-3 sm:p-1 bg-green-300 rounded-lg">----</b>
                                    <b v-else class="px-3 py-3 sm:p-1 bg-red-300 text-red-800 rounded-lg">{{car.driver.name}}</b>
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Manutenções</dt>
                                <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <div class="flow-root">{{}}
                                        <ul role="list" class="-mb-8">
                                            <li v-for="(event, eventIdx) in maint" :key="event.id">
                                                <div class="relative pb-8">
                                                    <span v-if="eventIdx !== maint.length - 1" class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true" />
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                                              <span :class="[event.iconBackground, 'h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white']">
                                                                <component :is="event.icon" class="h-5 w-5 text-white" aria-hidden="true" />
                                                              </span>
                                                        </div>
                                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                            <div>
                                                                <p v-if="event.oil !== null" class="text-sm text-gray-500">
                                                                    {{ event.service }} para {{ event.oil }} Km, <a :href="route('carMain.show', event.id)" class="font-medium bold text-gray-900"> Ver Manutenção</a>
                                                                </p>
                                                                <p v-else class="text-sm text-gray-500">
                                                                    {{ event.service }}, <a :href="route('carMain.show', event.id)" class="font-medium bold text-gray-900"> Ver Manutenção</a>
                                                                </p>
                                                            </div>
                                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                                <time :is="getDate(event.created_at)">{{dateMaint(a)}}</time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { WrenchIcon } from '@heroicons/vue/20/solid'
import moment from 'moment-timezone';

export default {
    name: "ShowCars",
    components: {
        AuthenticatedLayout,
        Head,
        WrenchIcon,

    },
    props: ['errors', 'car', 'driver', 'maint'],
    data() {
        return {
            editMode: false,
            errors: [],
        }
    },
    methods: {
        // Define a method to calculate the bar color based on the value.
        getBarColor(value) {
            if (value === 100) {
                return '#04B404'; // Change to your desired color class
            } else if (value === 75) {
                return '#82FA58'; // Change to your desired color class
            } else if (value === 50) {
                return '#FFD700'; // Change to your desired color class
            } else if (value === 25) {
                return '#FE9A2E'; // Change to your desired color class
            } else {
                return '#DF0101'; // Change to your desired color class
            }
        },
        getDate(a){
            console.log(a)
        },
        dateMaint (a){
            moment.updateLocale('pt', {
                months : [
                    "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho",
                    "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
                ]
            });

            return moment.tz(this.a, 'America/Sao_Paulo').format('DD MMMM YYYY');
        },
    },

}
</script>
