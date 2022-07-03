<template>
  <div class="p-card p-component">
    <div class="p-card-body">
      <div class="p-card-content">
        <div class="row col-md-12">
          <div v-for="option in brandsListOptions" class="col-md-2">
            <div class="align-items-center justify-content-center" style="display: flex">
              <img :src="originPathName + option.image" :alt="option.name" style="width: 70%">
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
    name: 'BrandsLists',

    mixins:[
      pathName
    ],

    data:() => ({
        brandsListOptions: []
    }),

    mounted() {
        this.getBrandsList();
    },

    methods: {
        async getBrandsList() {
            const response = await this.$http.get('/api/brands');
            this.brandsListOptions = response.data.data;
        },
    }
}
</script>
