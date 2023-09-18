<template>
    <div>
        <ul>
            <li v-for="item in filteredItems" :key="item.id">{{ item.name }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "CallComponent",
    props: ['call'],
    data() {
        return {
            data: [

            ],
        };
    },
    computed: {
        filteredItems() {
            // Use JavaScript's `filter` method to filter out items based on the condition
            return this.data.filter(item => item.name.startsWith('Maintenance'));
        },
    },
}
</script>

<style scoped>

</style>
