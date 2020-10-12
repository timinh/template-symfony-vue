<template>
  <main-layout>
    <router-view/>
  </main-layout>
</template>
<script>
import MainLayout from './layouts/MainLayout'
export default {
  components: {
    MainLayout
  }
}
</script>