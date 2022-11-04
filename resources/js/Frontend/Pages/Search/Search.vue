<template>
  <div class="container-fluid">
    <div class="justify-content-center m-2">
      <div class="card">
        <div class="card-header">
          <form @submit.prevent="submit" @keyup.enter="submit">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <input
                    id="product_id"
                    v-model="product_id"
                    type="text"
                    class="form-control"
                    :placeholder="$t('search.input.product_id')"
                  >
                </div>
<!--                <div class="col-md-3">
                  <input
                    id="brand"
                    v-model="brand"
                    type="text"
                    class="form-control"
                    :placeholder="$t('search.input.brand')"
                  >
                </div>-->
                <div class="col-md-3">
                  <Button class="p-button-sm p-button-secondary p-button-outlined" :label="$t('search.title')" @click="submit" />
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="card-body">
          <search-list v-if="searchListOptions" :search-list-options="searchListOptions"></search-list>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SearchList from './SearchList';
import Form from 'form-backend-validation';

export default {
    name: 'Search',

    components: {
        SearchList
    },

    data: () => ({
        product_id: null,
        brand: null,
        searchListOptions: null,
    }),

    mounted(){
      this.product_id = this.$route.query.product_id
      this.brand = this.$route.query.brand
    },

    methods: {
        async submit() {
            if(!(this.product_id || this.brand)){
                return;
            }

            const route = `/search?product_id=${this.product_id}&brand=${this.brand}`;
            const currentRoute = `${this.$route.path}?product_id=${this.$route.query.product_id}&brand=${this.$route.query.brand}`;

            if(route !== currentRoute){
                await this.$router.replace({ name: 'search', query: {product_id: this.product_id || '', brand: this.brand || ''}});
            }

            const response = await this.$http.get(`/api/products?product_id=${this.product_id || '' }&brand=${this.brand || '' }&search=1`);
            this.searchListOptions = response.data.data;
        },
    }
}
</script>
