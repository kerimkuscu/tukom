<template>
    <div>
        <MegaMenu :model="items" />
    </div>
</template>

<script>
export default {
    name: 'Menu',

    data: () => ({
        items: []
    }),

    mounted() {
        this.getMenuList();
    },

    methods: {
        async getMenuList() {
            const response = await this.$http.get('/api/menus/getMenuList')
            this.items = response.data.data;
            window.localStorage.setItem('menu', JSON.stringify(items));
        }
    }
}
</script>

<style>
.p-megamenu {
    background: transparent !important;
    color: transparent !important;
    border: 0;
}
</style>
