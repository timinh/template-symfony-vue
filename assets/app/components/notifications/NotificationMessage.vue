<template>
  <div class="toast show fade" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header" :class="toastType">
      &nbsp;
    </div>
    <div class="toast-body">
      {{notification.message}}
    </div>
  </div>
</template>

<script>
import { onMounted, onBeforeUnmount, computed } from 'vue'
import { useNotifications } from '../../composition/use-notifications'

export default {
  name: 'NotificationMessage',
  props: {
    notification: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    let timeout = null
    const defaultDelay = 3
    const {removeNotification} = useNotifications()

    onMounted( () => {
      const delay = props.notification.delay ? props.notification.delay : defaultDelay
      timeout = setTimeout( () => {
        removeNotification(props.notification)
      }, delay*1000)
    })

    onBeforeUnmount( () => {
      clearTimeout(timeout)
    })

    const toastType = computed( () => {
      return props.notification.type ? 'bg-' + props.notification.type : 'bg-' + 'info'
    })

    return {toastType}
  }
}
</script>
