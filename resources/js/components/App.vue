<template>
  <div>
    <Toast position="top-right" />
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
