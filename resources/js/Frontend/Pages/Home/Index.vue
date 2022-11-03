<template>
  <div>
    <GalleriaList />
    <ProductList />
    <BrandsLists />
    <Markets />
    <FirmsLists />
    <Footer />
  </div>
</template>

<script>
import GalleriaList from './GalleriaList';
import ProductList from './ProductList';
import BrandsLists from './BrandsLists';
import Markets from './Markets';
import FirmsLists from './FirmsLists';
import Footer from './Footer';
export default {
    name: 'Index',

    components: {
        GalleriaList,
        ProductList,
        BrandsLists,
        Markets,
        FirmsLists,
        Footer
    },

    data: () => ({}),
}
</script>
