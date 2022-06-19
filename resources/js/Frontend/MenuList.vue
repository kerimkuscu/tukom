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
        items: [
            {
                label: 'Options',
                items: [
                    {label: 'New', icon: 'pi pi-fw pi-plus', command:() => {} },
                    {label: 'Delete', icon: 'pi pi-fw pi-trash', url: 'https://www.primetek.com.tr'}
                ]
            },
            {
                label: 'Account',
                items: [
                    {label: 'Options', icon: 'pi pi-fw pi-cog', to: '/options'},
                    {label: 'Sign Out', icon: 'pi pi-fw pi-power-off', to: '/logout'}
                ]
            },

            {
                "label": "Adaptör",
                "items": [
                    [
                        {
                            "label": "RF Adaptörü",
                            "items": []
                        },
                        {
                            "label": "Su Geçirmez USB Adaptör",
                            "items": []
                        }
                    ]
                ]
            },
        ],
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
