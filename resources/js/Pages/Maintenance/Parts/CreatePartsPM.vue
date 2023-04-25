<template>
    <Head title="Adicionar de Peças" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Adicionar de Peças</h2>
        </template>

        <div class="p-2 py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="grid grid-cols-1 p-4 pt-10 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Peças PMSC</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Entrada de peças PMSC para estoque.</p>
                    </div>

                    <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                                <div class="mt-2">
                                    <!-- {{ parts.description }} -->
                                    <input type="text" name="description" id="description" :value="parts.description" readonly class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                                </div>

                                <div class="sm:col-span-3">
                                <label for="amount" class="block text-sm font-medium leading-6 text-gray-900">Quantidade</label>
                                <div class="mt-2">
                                    <input type="number" min="1" max="1000" v-model="form.amount" name="amount" id="amount" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
                        <button type="button" @click="submit()" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
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
    props: ['errors', 'parts'],

    data() {
        return {
            form: this.$inertia.form({
                _method: 'put',
                amount: null,
            }),
        }
    },
    methods: {
        submit() {
        this.form.put(`/part/${this.parts.id}`, {
            // onSuccess: () => this.form.reset('password', 'photo'),
        })
    },
        // submit(data) {
        //     console.log(data)
        //     this.form.put(route("part.update", this.parts.id));
        // },
    },
}
</script>
