<template>
  <div class="p-card p-component">
    <div class="p-card-body">
      <div class="p-card-content">
        <div class="row col-md-12">
          <div v-for="option in productListOptions" :key="option.id" class="col-md-2">
            <div class="p-card p-component" style="margin-bottom: 25px">
              <div
                v-if="option.image !==null"
                class="p-card-content align-items-center justify-content-center"
                style="display: flex; padding: 0"
              >
                <Galleria
                  :value="option.images"
                  :num-visible="5"
                  :circular="true"
                  style="max-width: 640px;"
                  :show-item-navigators="true"
                  :show-thumbnails="false"
                  :show-item-navigators-on-hover="true"
                  :show-indicators="false"
                  :auto-play="true"
                >
                  <template #item="slotProps">
                    <img
                      :src="originPathName + slotProps.item[1]"
                      :alt="originPathName + slotProps.item[1]"
                      style="width: 100%; display: block;cursor: pointer"
                      @click="productDetail(option)"
                    >
                  </template>
                  <template #thumbnail="slotProps">
                    <img
                      :src="originPathName + slotProps.item[1]"
                      :alt="originPathName + slotProps.item[1]"
                      style="display: block;cursor: pointer"
                      @click="productDetail(option)"
                    >
                  </template>
                </Galleria>
              </div>
              <div
                v-else
                class="p-card-content align-items-center justify-content-center"
                style="display: flex; padding: 0"
              >
                <span>{{ $t('product.frontend.no_image') }}</span>
              </div>

              <div
                class="p-card-footer align-items-center justify-content-center"
                style="display: flex; padding: 0; cursor: pointer"
              >
                <div
                  class="align-items-center justify-content-center ellipsis"
                  @click="productDetail(option)"
                >
                  <b style="font-size: 20px !important;"> {{ option.description }} </b>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import pathName from '../../../mixins/pathName';

export default {
    name: 'ProductList',

    mixins: [
        pathName
    ],

    data: () => ({
        productListOptions: [],
    }),

    mounted() {
        this.getProductsList();
    },

    methods: {
        async getProductsList() {
            const response = await this.$http.get('/api/product-list');
            this.productListOptions = response.data.data;
        },

        productDetail(item) {
            this.$eventHub.$emit('products-details', item);
            let urlProductName = item.menu;
            urlProductName = urlProductName.replace(/\s+/g, '-').toLowerCase();
            this.$router.push({ name: 'products.details', params: { productName: urlProductName, productId: item.id } });
        },
    }
}
</script>

<style scoped>

</style>
