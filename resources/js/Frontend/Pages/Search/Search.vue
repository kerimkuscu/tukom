<template>
  <div class="container-fluid">
    <div class="justify-content-center m-2">
      <div class="card">
        <div class="card-header">
          <form @submit.prevent="submit">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <input
                    id="product_id"
                    v-model="form.product_id"
                    type="text"
                    class="form-control"
                    :placeholder="$t('search.input.product_id')"
                  >
                </div>
                <div class="col-md-3">
                  <input
                    id="description"
                    v-model="form.type"
                    type="text"
                    class="form-control"
                    :placeholder="$t('search.input.type')"
                  >
                </div>
                <div class="col-md-3">
                  <input
                    id="description"
                    v-model="form.brand"
                    type="text"
                    class="form-control"
                    :placeholder="$t('search.input.brand')"
                  >
                </div>
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
        form: new Form({
            product_id: null,
            type: null,
            brand: null,
        }),
        searchListOptions: null,
    }),

    methods: {
        async submit() {
            const response = await this.form.post('....');
            this.searchListOptions = response.data.data;
        },
    }
}
</script>
