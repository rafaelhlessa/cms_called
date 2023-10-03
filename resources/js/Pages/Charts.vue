<template>
    <Head title="Charts" />

    <AuthenticatedLayout>
        <div class="p-10">
            <div class="relative isolate rounded-2xl shadow-2xl shadow-violet-500 overflow-hidden bg-gray-900 py-24 sm:py-32">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2850&q=80&blend=111827&blend-mode=multiply&sat=-100&exp=15" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover" />
                <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="absolute -bottom-8 -left-96 -z-10 transform-gpu blur-3xl sm:-bottom-64 sm:-left-40 lg:-bottom-32 lg:left-8 xl:-left-10" aria-hidden="true">
                        <div class="aspect-[1266/975] w-[79.125rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
                    </div>
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <h2 class="text-base font-semibold leading-8 text-indigo-400">Chamados</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">CMS - DTIC / 2023</p>
                        <p class="mt-6 text-lg leading-8 text-gray-300">

                        </p>
                    </div>
                    <dl class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 text-white sm:mt-20 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                        <div class="flex flex-col gap-y-3 border-l border-white/10 pl-6">
                            <dt style="width: 500px">Aquisições</dt>
                            <DoughnutChart :chartData="acqui" />
                        </div>
                        <div class="flex flex-col gap-y-3 border-l border-white/10 pl-6">
                            <dt style="width: 500px">Manutenções</dt>
                            <DoughnutChart :chartData="mainte" />
                        </div>
                        <div class="flex flex-col gap-y-3 border-l border-white/10 pl-6">
                            <dt style="width: 500px">Câmeras / Docas</dt>
                            <DoughnutChart :chartData="cam" />
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { DoughnutChart } from 'vue-chart-3';
import { Chart, registerables } from "chart.js";

Chart.register(...registerables);

export default {
    name: "Charts",
    components: {
        AuthenticatedLayout,
        Head,
        DoughnutChart
    },
    props: ['acquisition', 'maintenance', 'camera'],

    data() {
        return {
            stats1: '',
            stats2: '',
            stats3: '',
            acquiData: {},
            maintData: {},
            camData: {},
        }
    },
    methods: {

    },
    mounted() {
        // Fetch or generate your data from the `acqui` function
        this.acquiData = this.acqui();
        this.maintData = this.mainte();
        this.camData = this.cam();
    },
    computed: {
        acqui: function () {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();


            const aquisicao = new Set(this.acquisition.map((i) => ({
                'name': i[1],
                'id': i[2],
                'group': i[8],
                'status': i[12],
                'opendate': i[15],
                'closedate': i[16],
                'problem': i[21],
            })));

            const filteredOpen = [];
            const filteredPend = [];
            const filteredSolut = [];
            const filteredClose = [];

            aquisicao.forEach(item => {
                if (item.status <= 3) {
                    filteredOpen.push(item);
                } else if (item.status === 4) {
                    filteredPend.push(item)
                } else if (item.status === 5) {
                    filteredSolut.push(item)
                } else if (item.status === 6) {
                    filteredClose.push(item)
                }
            });

            const currentYearOpen = filteredOpen.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearPend = filteredPend.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearSolut = filteredSolut.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearClose = filteredClose.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            return {
                labels: ['Abertos', 'Pendentes', 'Solucionados', 'Fechados'],
                datasets: [
                    {
                        data: [currentYearOpen, currentYearPend, currentYearSolut, currentYearClose],
                        backgroundColor: ['#7CFC00', '#FF8C00', '#A9A9A9', '#1C1C1C'],
                    },
                ],
            }


        },
        mainte: function () {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();


            const manutencao = new Set(this.maintenance.map((i) => ({
                'name': i[1],
                'id': i[2],
                'group': i[8],
                'status': i[12],
                'opendate': i[15],
                'closedate': i[16],
                'problem': i[21],
            })));

            const filteredOpen = [];
            const filteredPend = [];
            const filteredSolut = [];
            const filteredClose = [];

            manutencao.forEach(item => {
                if (item.status <= 3) {
                    filteredOpen.push(item);
                } else if (item.status === 4) {
                    filteredPend.push(item)
                } else if (item.status === 5) {
                    filteredSolut.push(item)
                } else if (item.status === 6) {
                    filteredClose.push(item)
                }
            });

            const currentYearOpen = filteredOpen.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearPend = filteredPend.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearSolut = filteredSolut.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearClose = filteredClose.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            return {
                labels: ['Abertos', 'Pendentes', 'Solucionados', 'Fechados'],
                datasets: [
                    {
                        data: [currentYearOpen, currentYearPend, currentYearSolut, currentYearClose],
                        backgroundColor: ['#7CFC00', '#FF8C00', '#A9A9A9', '#1C1C1C'],
                    },
                ],
            }


        },
        cam: function () {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();


            const cam = new Set(this.camera.map((i) => ({
                'name': i[1],
                'id': i[2],
                'group': i[8],
                'status': i[12],
                'opendate': i[15],
                'closedate': i[16],
                'problem': i[21],
            })));

            const filteredOpen = [];
            const filteredPend = [];
            const filteredSolut = [];
            const filteredClose = [];

            cam.forEach(item => {
                if (item.status <= 3) {
                    filteredOpen.push(item);
                } else if (item.status === 4) {
                    filteredPend.push(item)
                } else if (item.status === 5) {
                    filteredSolut.push(item)
                } else if (item.status === 6) {
                    filteredClose.push(item)
                }
            });

            const currentYearOpen = filteredOpen.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearPend = filteredPend.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearSolut = filteredSolut.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            const currentYearClose = filteredClose.filter((record) => {
                const recordDate = new Date(record.opendate);
                return (
                    recordDate.getFullYear() === currentYear
                );
            }).length;

            return {
                labels: ['Abertos', 'Pendentes', 'Solucionados', 'Fechados'],
                datasets: [
                    {
                        data: [currentYearOpen, currentYearPend, currentYearSolut, currentYearClose],
                        backgroundColor: ['#7CFC00', '#FF8C00', '#A9A9A9', '#1C1C1C'],
                    },
                ],
            }


        },
    },

}

</script>

<style scoped>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
