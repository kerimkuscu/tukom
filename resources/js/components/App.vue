<template>
  <div>
    <Toast position="top-right" :base-z-index="1999" />
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
