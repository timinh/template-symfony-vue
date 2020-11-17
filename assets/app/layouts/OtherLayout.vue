<template>
  <navbar :nav="items"/>
  <div class="autre_layout" />
  <main class="container mt-4">
    <slot />
  </main>
</template>
<script>
import Navbar from '../components/Navbar'
export default {
  name: 'MainLayout',
  components: {
    Navbar
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