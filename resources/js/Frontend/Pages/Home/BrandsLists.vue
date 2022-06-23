<template>
  <div class="p-card p-component">
    <div class="p-card-body">
      <div class="p-card-content">
        <div class="row col-md-12">
          <div v-for="option in imageOptions" class="col-md-2">
            <div class="align-items-center justify-content-center" style="display: flex">
              <img :alt="option.text" :src="option.path" style="width: 70%">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: 'BrandsLists',

    data:() => ({
        imageOptions: [
            { text: 'SPI', path: '/brands-images/spi.png' },
            { text: 'Telason', path: '/brands-images/telason.jpeg' },
            { text: 'Amphenol', path: '/brands-images/amphenol.png' },
            { text: 'ITT', path: '/brands-images/itt_cannon.png' },
            { text: 'TYCO', path: '/brands-images/tyco.png' },
            { text: 'Souriau', path: '/brands-images/souriau.png' },
            { text: 'Deutsch', path: '/brands-images/deutsch.png' },
            { text: 'DDK', path: '/brands-images/ddk.png' },
            { text: 'Sensata', path: '/brands-images/sensatab.png' },
            { text: 'DMC', path: '/brands-images/daniels.png' },
            { text: 'Astro', path: '/brands-images/astro.png' },
            { text: 'Corsair', path: '/brands-images/corsair.png' },
            { text: 'Cinch', path: '/brands-images/cinch.png' },
            { text: 'Airborn', path: '/brands-images/airborn.png' },
            { text: 'Glenair', path: '/brands-images/glenair.png' },
            { text: 'Conesys', path: '/brands-images/conesys.png' },
            { text: 'Tristar', path: '/brands-images/tristar.png' },
            { text: 'Kepco', path: '/brands-images/kepco.png' },
        ]
    })
}
</script>
