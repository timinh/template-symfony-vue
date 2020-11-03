<template>
  <div style="min-height: 100%;position: fixed; top:5%; left:5%; z-index:999;">
    <notification-message v-for="notification in notifications" :key="notification.id" :notification="notification" />
  </div>
</template>

<script>
import {useNotifications} from '../../composition/use-notifications'
import NotificationMessage from './NotificationMessage'

export default {
  name: 'NotificationsList',
  components: {
    NotificationMessage
  },
  setup() {
    const {notifications} = useNotifications()
    return { notifications }
  }
}
</script>
