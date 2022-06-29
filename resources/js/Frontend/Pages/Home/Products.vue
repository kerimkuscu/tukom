<template>
    <div>
        <div class="m-2">
            <h3>{{ productHeader }}</h3>
        </div>
        <div class="row col-md-12">
            <div v-for="option in productsOptions" class="col-md-2">
                <div class="p-card p-component" style="margin-bottom: 25px" @click="productDetail(option)">
                    <div v-if="option.image !==null" class="p-card-content align-items-center justify-content-center" style="display: flex">
                        <img :alt="option.description" :src="'http://tukom.test/images/' + option.image" style="width: 70%">
                    </div>
                    <div v-else class="p-card-content align-items-center justify-content-center" style="display: flex">
                        <span>No image found</span>
                    </div>

                    <div class="p-card-footer align-items-center justify-content-center" style="display: flex">
                        <div class="align-items-center justify-content-center ellipsis">
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
            this.productsOptions = response.data.data;
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
            this.$eventHub.$emit('products-details', item);
            let urlProductName = item.menu;
            urlProductName = urlProductName.replace(/\s+/g, '-').toLowerCase();
            this.$router.push({ name: 'products.details', params: { productName: urlProductName,  productId: item.id } });
        }
    },
}
</script>

<style>
.ellipsis {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
