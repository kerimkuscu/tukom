<template>
  <div>
    <Galleria
      :value="galleriaListOptions"
      :num-visible="5"
      :circular="true"
      :auto-play="true"
      style="max-width: 120em"
      :show-item-navigators="true"
      :show-thumbnails="false"
    >
      <template #item="slotProps">
        <img :src="originPathName + slotProps.item.image" :alt="originPathName + slotProps.item" style="width: 1920px !important; height: 750px !important;; display: block;">
      </template>
    </Galleria>
  </div>
</template>

<script>
import pathName from '../../../mixins/pathName';
export default {
    name: 'GalleriaList',

    mixins: [
        pathName
    ],

    data: () => ({
        galleriaListOptions: [],
    }),

    mounted() {
        this.getGalleriaList();
    },

    methods: {
        async getGalleriaList() {
            const response = await this.$http.get('/api/carousels');
            this.galleriaListOptions = response.data.data;
        },
    }
}
</script>
