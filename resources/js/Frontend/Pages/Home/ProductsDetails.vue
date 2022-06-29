<template>
  <div>
    detay
  </div>
</template>

<script>
export default {
    name: 'ProductsDetails',

    data: () => ({
        productDetailsOptions: [],
        productHeader: null
    }),

    mounted() {
        this.$eventHub.$on('products-details', this.getProductDetails);
        this.fetchProductDetails();

    },

    methods: {
        async getProductDetails(item) {
            console.log(item);
            const response = await this.$http.get('/api/products/' + item.id);
            this.productDetailsOptions = response.data.data;
        },

        async fetchProductDetails() {
            const response = await this.$http.get('/api/products/' + this.$route.params.productId);
            this.productDetailsOptions = response.data.data;
        },
    },
}
</script>
