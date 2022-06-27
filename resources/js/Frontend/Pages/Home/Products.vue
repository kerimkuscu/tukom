<template>
    <div class="p-card p-component m-2">
        <div class="p-card-body">
            <div class="p-card-content">
                <div class="row col-md-12">
                    <div v-for="option in productsOptions" class="col-md-2">
                        <div class="align-items-center justify-content-center" style="display: flex">
                            <img :alt="option.text" :src="option.path" style="width: 70%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Products',

    data: () => ({
       productsOptions: [],
    }),

    mounted() {
        this.$eventHub.$on('sub-menu-item', this.getProductsList);
    },

    methods: {
        async getProductsList(item) {
            const response = await this.$http.get('/api/products?menu_id=' + item);
            this.productsOptions = response.data;
        }
    },
}
</script>
