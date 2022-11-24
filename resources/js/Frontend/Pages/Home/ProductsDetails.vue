<template>
  <div class="container-fluid">
    <div class="row justify-content-center m-2">
      <div class="card">
        <div class="card-body">
          <div class="card-header" style="font-size: 28px;font-weight: bold">
            {{ productDetailsOptions.description }}
          </div>

          <div class="row col-md-12">
            <div class="col-md-4">
              <Galleria
                :value="productDetailsOptions.images"
                :circular="true"
                style="max-width: 640px;"
                :show-thumbnails="false"
                :show-indicators="true"
                :change-item-on-indicator-hover="true"
                :show-indicators-on-item="true"
                :auto-play="true"
              >
                <template #item="slotProps">
                  <img :src="originPathName + slotProps.item[1]" :alt="originPathName + slotProps.item[1]" style="width: 100%; display: block;">
                </template>
              </Galleria>
            </div>
            <div class="col-md-8 mt-5">
              <h4>{{ $t('product.frontend.brand') }}: {{ productDetailsOptions.brand }}</h4>
              <h4>{{ $t('product.frontend.name') }}: {{ productDetailsOptions.description }}</h4>,,,
              <h4>{{ $t('product.frontend.fiili_stok') }}: {{ productDetailsOptions.fiili_stok }}</h4>
              <h4 v-if="productDetailsOptions.show_price === true">
                {{ $t('product.frontend.price') }}: {{ productDetailsOptions.price }} {{ productDetailsOptions.currency }}
              </h4>
              <h4>
                {{ $t('product.form.technical_data_sheet') }}: <a href="javascript:void(0)" @click="getFilePath(productDetailsOptions.file)" style="font-size: 12px"><i class="pi pi-file-pdf" style="cursor: pointer" /> {{ productDetailsOptions.description }} {{ $t('product.form.data_sheet') }}</a>
              </h4>
              <hr>
              <h4 v-if="productDetailsOptions.special_code_1 !== null">
                {{ $t('product.frontend.features') }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_1 !== null">
                {{ productDetailsOptions.special_code_1 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_2 !== null">
                {{ productDetailsOptions.special_code_2 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_3 !== null">
                {{ productDetailsOptions.special_code_3 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_4 !== null">
                {{ productDetailsOptions.special_code_4 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_5 !== null">
                {{ productDetailsOptions.special_code_5 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_6 !== null">
                {{ productDetailsOptions.special_code_6 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_7 !== null">
                {{ productDetailsOptions.special_code_7 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_8 !== null">
                {{ productDetailsOptions.special_code_8 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_9 !== null">
                {{ productDetailsOptions.special_code_9 }}
              </h4>
              <h4 v-if="productDetailsOptions.special_code_10 !== null">
                {{ productDetailsOptions.special_code_10 }}
              </h4>
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
        originPathName: null,
        originFilePathName: null,
    }),

    mounted() {
        this.$eventHub.$on('products-details', this.getProductDetails);
        this.fetchProductDetails();
        this.getImagePath()
        this.getFilePath()
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

        getImagePath() {
            this.originPathName = window.location.origin + '/images/';
        },

        getFilePath(file) {
            if(file && file[1]) {
                let origin = window.location.origin;
                window.open(origin + '/files/' + file[1]);
                return;
            }

            return '';
        }
    },
}
</script>
