<template>
  <div>
    <GalleriaList />
    <BrandsLists />
    <Markets />
  </div>
</template>

<script>
import GalleriaList from './GalleriaList';
import BrandsLists from './BrandsLists';
import Markets from './Markets';
export default {
    name: 'Index',

    components: {
        GalleriaList,
        BrandsLists,
        Markets
    },

    data: () => ({}),
}
</script>
