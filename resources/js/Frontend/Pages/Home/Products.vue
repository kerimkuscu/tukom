<template>
  <div>
    <div class="m-2">
      <h3>{{ productHeader }}</h3>
    </div>
    <div class="row col-md-12">
      <div v-for="option in productsOptions" class="col-md-2">
        <div class="p-card p-component" style="margin-bottom: 25px">
          <div v-if="option.image !==null" class="p-card-content align-items-center justify-content-center" style="display: flex; padding: 0">
            <Galleria
              :value="option.images"
              :num-visible="5"
              :circular="true"
              style="max-width: 640px;"
              :show-item-navigators="true"
              :show-thumbnails="false"
              :show-item-navigators-on-hover="true"
              :show-indicators="false"
              :autoPlay="true"
            >
              <template #item="slotProps">
                <img :src="originPathName + slotProps.item[1]" :alt="originPathName + slotProps.item[1]" style="width: 100%; display: block;">
              </template>
              <template #thumbnail="slotProps">
                <img :src="originPathName + slotProps.item[1]" :alt="originPathName + slotProps.item[1]" style="display: block;">
              </template>
            </Galleria>
          </div>
          <div v-else class="p-card-content align-items-center justify-content-center" style="display: flex; padding: 0">
            <span>{{ $t('product.frontend.no_image') }}</span>
          </div>

          <div class="p-card-footer align-items-center justify-content-center" style="display: flex; padding: 0; cursor: pointer">
            <div class="align-items-center justify-content-center ellipsis" @click="productDetail(option)">
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
        productHeader: null,
        originPathName: null,
    }),

    mounted() {
        this.$eventHub.$on('sub-menu-item', this.getProductsList);
        this.fetchProductList();
        this.getPathName();
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
        },

        getPathName() {
            this.originPathName = window.location.origin + '/images/';
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
