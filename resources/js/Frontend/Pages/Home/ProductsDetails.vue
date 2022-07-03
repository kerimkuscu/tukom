<template>
    <div class="container-fluid">
        <div class="row justify-content-center m-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        {{ productDetailsOptions.card_code }} - {{ productDetailsOptions.description }}
                    </div>

                    <div class="row col-md-12">
                            <div class="col-md-6">
                                <Galleria :value="productDetailsOptions.images" :circular="true" style="max-width: 640px;" :showThumbnails="false" :showIndicators="true" :changeItemOnIndicatorHover="true" :showIndicatorsOnItem="true">
                                    <template #item="slotProps">
                                        <img :src="originPathName + slotProps.item[1]" :alt="originPathName + slotProps.item[1]" style="width: 100%; display: block;" />
                                    </template>
                                </Galleria>
                            </div>
                            <div class="col-md-6">
                                <div v-for="option in productDetailsOptions">
                                    <label :for="option">{{ option }}</label>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductsDetails',

    data: () => ({
        productDetailsOptions: [],
        originPathName: null
    }),

    mounted() {
        this.$eventHub.$on('products-details', this.getProductDetails);
        this.fetchProductDetails();
        this.getPathName()
    },

    methods: {
        async getProductDetails(item) {
            const response = await this.$http.get('/api/products/' + item.id);
            this.productDetailsOptions = response.data.data;
        },

        async fetchProductDetails() {
            const response = await this.$http.get('/api/products/' + this.$route.params.productId);
            this.productDetailsOptions = response.data.data;
        },

        getPathName() {
            this.originPathName = window.location.origin + '/images/';
        }
    },
}
</script>
