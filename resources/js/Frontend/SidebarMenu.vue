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
        items: [
            {
                "label":"Adaptör",
                "items":[{"label":"RF Adaptörü","id":"LPkNg1lqmVa"}]},
            {"label":"Anten"},
            {"label":"Tel ve Kablo","items":[{"label":"Test","id":"voOrz8XzYK9"}]},
            {"label":"Elektronik Anahtar","items":[{"label":"alt menü 1","id":"m29OgYegwyb", "items":[{"label":"Test","id":"voOrz8XzYK9"}] }]}
        ],
        visibleLeft: false,
    }),

    mounted() {
        //this.getMegaMenuList();
    },

    methods: {
        async getMegaMenuList() {
            const response = await this.$http.get('/api/menus/getMegaMenuList')
            this.items = response.data.data;
        },
    }
}
</script>
