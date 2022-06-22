<template>
  <div>
    <Sidebar :visible.sync="visibleLeft">
      <SidebarMenuList :model="items" />
    </Sidebar>

    <Button type="button" class="p-button-outlined p-button-secondary" icon="pi pi-bars" @click="visibleLeft = true" />
  </div>
</template>

<script>

import SidebarMenuList from './SidebarMenuList';

export default {
    name: 'SidebarMenu',

    components: {
      SidebarMenuList
    },

    data: () => ({
        items: [],
        visibleLeft: false,
    }),

    mounted() {
        let item = window.localStorage.getItem('menu')
        item ? this.items = JSON.parse(item) : this.getMegaMenuList();
    },

    methods: {
        async getMegaMenuList() {
            const response = await this.$http.get('/api/menus/getMegaMenuList')
            this.items = response.data.data;
            window.localStorage.setItem('menu', JSON.stringify(this.items));
        },
    }
}
</script>
