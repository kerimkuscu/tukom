<template>
  <div class="container-fluid">
    <div class="row justify-content-center m-2">
      <div class="card">
        <div class="card-body">
          <router-view />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: 'ContactIndex'
}
</script>
