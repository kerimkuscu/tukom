<template>
  <div>
    <div class="align-items-center justify-content-center" style="display: flex; margin: 10px 0 10px 0">
      <h1>MARKETS</h1>
    </div>
    <div class="row col-md-12">
      <div v-for="item in getMarketsListOption" class="col-md-3">
        <Card style="margin: 10px">
          <template #header>
            <img :src="originPathName + item.image" :alt="item.name">
          </template>
          <template #title>
            <div class="align-items-center justify-content-center" style="display: flex">
              {{ item.name }}
            </div>
          </template>
        </Card>
      </div>
    </div>
  </div>
</template>

<script>
import pathName from '../../../mixins/pathName';
export default {
    name: 'Markets',

    mixins:[
      pathName
    ],

    data:() => ({
        getMarketsListOption: [],
    }),

    mounted() {
        this.getMarketsList();
    },

    methods: {
        async getMarketsList() {
            const response = await this.$http.get('/api/markets');
            this.getMarketsListOption = response.data.data;
        },
    }
}
</script>
