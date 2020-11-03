import {ref, computed} from 'vue'

const notifications = ref([])

export function useNotifications() {

  const addNotification = (notification) => {
    notifications.value.push({
      ...notification,
      id: (Math.random().toString() + Date.now().toString(36)).substr(2)
    })
  }

  const removeNotification = (toRemove) => {
    notifications.value = notifications.value.filter(notification => {
      return notification.id != toRemove.id
    })
  }

  return {
    notifications: computed( () => notifications.value),
    addNotification,
    removeNotification
  }
}