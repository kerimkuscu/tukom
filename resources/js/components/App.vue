<template>
  <div>
    <Toast position="top-right" :baseZIndex="1999" />
    <router-view />
  </div>
</template>

<script>
import Toast from 'primevue/toast';

export default {
    name: 'Root',

    components: {
        Toast
    },
}
</script>
