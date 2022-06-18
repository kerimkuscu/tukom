<template>
    <div>
        <MegaMenu :model="items" />
    </div>
</template>

<script>
export default {
    name: 'Menu',

    data: () => ({
        items: [],

    }),

    mounted() {
        this.getMegaMenuList();
    },

    methods: {
        async getMegaMenuList() {
            const response = await this.$http.get('/api/menus/getMegaMenuList')
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
