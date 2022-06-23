<template>
  <div>
    <Galleria
      :value="images"
      :num-visible="5"
      :circular="true"
      :auto-play="true"
      style="max-width: 120em"
      :show-item-navigators="true"
      :show-thumbnails="false"
    >
      <template #item="slotProps">
        <img :src="slotProps.item.itemImageSrc" :alt="slotProps.item.alt" style="width: 1920px !important; height: 750px !important;; display: block;">
      </template>
    </Galleria>
  </div>
</template>

<script>
export default {
    name: 'GalleriaList',
    data: () => ({
        images: [
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria1.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria1s.jpg',
                'alt': 'Description for Image 1',
                'title': 'Title 1'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria2.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria2s.jpg',
                'alt': 'Description for Image 2',
                'title': 'Title 2'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria3.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria3s.jpg',
                'alt': 'Description for Image 3',
                'title': 'Title 3'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria4.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria4s.jpg',
                'alt': 'Description for Image 4',
                'title': 'Title 4'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria5.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria5s.jpg',
                'alt': 'Description for Image 5',
                'title': 'Title 5'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria6.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria6s.jpg',
                'alt': 'Description for Image 6',
                'title': 'Title 6'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria7.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria7s.jpg',
                'alt': 'Description for Image 7',
                'title': 'Title 7'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria8.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria8s.jpg',
                'alt': 'Description for Image 8',
                'title': 'Title 8'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria9.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria9s.jpg',
                'alt': 'Description for Image 9',
                'title': 'Title 9'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria10.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria10s.jpg',
                'alt': 'Description for Image 10',
                'title': 'Title 10'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria11.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria11s.jpg',
                'alt': 'Description for Image 11',
                'title': 'Title 11'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria12.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria12s.jpg',
                'alt': 'Description for Image 12',
                'title': 'Title 12'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria13.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria13s.jpg',
                'alt': 'Description for Image 13',
                'title': 'Title 13'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria14.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria14s.jpg',
                'alt': 'Description for Image 14',
                'title': 'Title 14'
            },
            {
                'itemImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria15.jpg',
                'thumbnailImageSrc': 'https://www.primefaces.org/primevue-v2/demo/images/galleria/galleria15s.jpg',
                'alt': 'Description for Image 15',
                'title': 'Title 15'
            }
        ]
    }),
}
</script>
