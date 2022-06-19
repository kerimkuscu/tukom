<template>
  <div>
      <Button type="button" class="p-button-outlined p-button-secondary" @click="toggle" icon="pi pi-bars" />
      <Menu ref="menu" :model="items" :popup="true" />
  </div>
</template>

<script>
export default {
    name: 'MenuList',

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
        },

        toggle(event) {
            this.$refs.menu.toggle(event);
        }
    }
}
</script>
