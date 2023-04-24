<template>
    <Head title="Manutenção" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Manutenção</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-4 border-b border-gray-200">
                        <div class="sm:flex sm:items-baseline">
                            <div>
                                <h3 class="text-base font-semibold leading-6 text-gray-900">Menu</h3>
                            </div>

                            <div class="mt-4 sm:ml-10 sm:mt-0">
                                <nav class="flex -mb-px space-x-8">
                                    <a v-for="tab in tabs" :key="tab.name" :href="tab.href"
                                        :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium']"
                                        :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</a>
                                </nav>
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

export default {
    name: "EntranceCreate",
    components: {
        AuthenticatedLayout,
        Head
    },
    data() {
        return {
            editMode: false,
            errors:[],
            tabs:[
                { name: 'Compras', href: '/purchases', current: true },
                { name: 'Garantias', href: '#', current: false },
                { name: 'Peças', href: '/parts', current: false },
            ]
        }
    },
}
</script>
