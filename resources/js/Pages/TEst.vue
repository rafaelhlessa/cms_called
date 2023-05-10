<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="sm:flex sm:items-center">
                <div class="m-6 sm:flex-auto">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">Jogadores</h2>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">

                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="bg-gray-100">
                        <form @submit.prevent>
                            <label for="menu">Select an item:</label>
                            <select id="menu" v-model="selectedItem">
                                <option value="">Please select an item</option>
                                <option v-for="(item, index) in menuItems" :key="index" :value="item.id">{{ item.name }}
                                </option>
                            </select>
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" v-model.number="quantity" min="1">
                            <button @click.prevent="addItem">Add Item</button>
                        </form>
                        <ul>
                            <li v-for="(item, index) in itemList" :key="index">{{ item.name }} - Quantity: {{ item.quantity
                            }}</li>
                        </ul>
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
        Head,
    },
    data() {
        return {
        selectedItem: '',
        quantity: 1,
        menuItems: [
            { id: 1, name: 'Item 1' },
            { id: 2, name: 'Item 2' },
            { id: 3, name: 'Item 3' },
        ],
        itemList: [],
        };
    },
    methods: {
        addItem() {
        const selectedItem = this.menuItems.find(item => item.id === Number(this.selectedItem));
        if (!selectedItem) {
            return;
        }
        const newItem = {
            name: selectedItem.name,
            quantity: this.quantity,
        };
        this.itemList.push(newItem);
        this.selectedItem = '';
        this.quantity = 1;
        },
    },
}

</script>

<style scoped>
.select2-container {
    min-width: 100% !important;
}</style>
