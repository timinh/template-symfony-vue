<template>
  <main-layout>
    <router-view v-slot="slotProps">
      <transition name="fade" mode="out-in">
        <component :is="slotProps.Component"></component>
      </transition>
    </router-view>
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