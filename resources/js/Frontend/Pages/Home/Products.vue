<template>
    <div>
        <div class="m-2">
            <h3>{{ productHeader }}</h3>
        </div>
        <div class="row col-md-12">
            <div v-for="option in productsOptions" class="col-md-3">
                <div class="p-card p-component m-2" @click="productDetail(option.id)">
                    <div class="p-card-content align-items-center justify-content-center" style="display: flex">
                        <img :alt="option.description" :src="'http://tukom.test/images/' + option.image" style="width: 70%">
                    </div>

                    <div class="p-card-footer">
                        <div class="align-items-center justify-content-center" style="display: flex">
                            {{ option.description }}
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
        productHeader: null
    }),

    mounted() {
        this.$eventHub.$on('sub-menu-item', this.getProductsList);
        this.fetchProductList();

    },

    methods: {
        async getProductsList(item) {
            const response = await this.$http.get('/api/products?menu_id=' + item);
            this.productsOptions = response.data;
            this.productName();
        },

        async fetchProductList() {
            const response = await this.$http.get('/api/products?menu_id=' + this.$route.params.id);
            this.productsOptions = response.data.data;
            this.productName();
        },

        productName() {
            this.productHeader = this.$route.params.productName.replace(/-/g, ' ').toUpperCase();
        },

        productDetail(item) {
            console.log(item);
        }
    },
}
</script>
