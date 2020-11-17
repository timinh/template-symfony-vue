<template>
  <component :is="layout">
    <router-view v-slot="slotProps">
      <notifications-list />
      <transition name="fade" mode="out-in">
        <component :is="slotProps.Component"></component>
      </transition>
    </router-view>
  </component>
</template>
<script>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import NotificationsList from './components/notifications/NotificationsList'
import DefaultLayout from './layouts/DefaultLayout'
import OtherLayout from './layouts/OtherLayout'

export default {
  components: {
    NotificationsList,
    DefaultLayout,
    OtherLayout
  },
  setup() {
    const route = useRoute()
    const defaultLayout = 'DefaultLayout'
    const layout = computed( () => {
      return route.meta.layout || defaultLayout
    })
    return {layout}
  }
}
</script>