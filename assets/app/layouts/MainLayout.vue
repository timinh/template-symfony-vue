<template>
<navbar :nav="items"/>
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
          label: 'A propos',
          link: '/private/about'
        }
      ]
    }
  }
}
</script>