<template>
  <div class="p-card p-component">
    <div class="p-card-body">
      <div class="p-card-content">
        <div class="row col-md-12">
          <div v-for="item in counterListOption" :key="item.value" class="col-md-3">
            <div class="align-items-center justify-content-center" style="display: flex">
              <i :class="item.icon" style="font-size: 5em" />
            </div>
            <div class="align-items-center justify-content-center" style="display: flex; font-size: 2rem">
              {{ item.value }}
            </div>
            <div class="align-items-center justify-content-center" style="display: flex">
              {{ item.text }}
            </div>
          </div>
        </div>

        <hr>

        <div class="row col-md-12">
          <div v-for="option in firmsListOptions" :key="option.name" class="col-md-2">
            <div class="align-items-center justify-content-center" style="display: flex">
              <img :src="originPathName + option.image" :alt="option.name" style="width: 100%">
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
    name: 'FirmsLists',

    mixins:[
      pathName
    ],

    data:() => ({
        firmsListOptions: [],
        counterListOption: [
            { text: 'Constant Customer', value: '43 +', icon: 'pi pi-users' },
            { text: 'Prototype Design Projects', value: '85 +', icon: 'pi pi-briefcase' },
            { text: 'Special Projects', value: '27', icon: 'pi pi-box' },
            { text: 'Products', value: '1000000 +', icon: 'pi pi-cog' },
        ]
    }),

    mounted() {
        this.getFirmsList();
    },

    methods: {
        async getFirmsList() {
            const response = await this.$http.get('/api/firms');
            this.firmsListOptions = response.data.data;
        },
    }
}
</script>
