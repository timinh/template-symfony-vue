<template>
  <navbar :nav="items"/>
  <main class="container mt-4">
    <notifications-list />
    <slot />
  </main>
</template>
<script>
import Navbar from '../components/Navbar'
import NotificationsList from '../components/notifications/NotificationsList'
export default {
  name: 'MainLayout',
  components: {
    Navbar,
    NotificationsList
  },
  setup() {
    return {
      items: [
        {
          label: 'Accueil',
          link: '/private'
        },
        {
          label: 'Exemple GraphQL',
          link: '/private/graphql'
        },
        {
          label: 'Persos envoyés par mail',
          link: '/private/about'
        }
      ]
    }
  }
}
</script>