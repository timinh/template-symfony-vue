<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"><img src="https://cdn.uca.fr/images/logos/UCA_logo_long_blanc.png"></a>
    <button class="navbar-toggler" @click="menuCollapsed = !menuCollapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse" :class="(menuCollapsed) ? 'collapse' : ''" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item" v-for="(n, index) in nav" :key="index">          
          <router-link  tag="a" class="nav-link" :to="n.link">
            {{n.label}}
          </router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script>
import { ref } from 'vue'
export default {
  name: 'Navbar',
  props: {
    nav: {
      type: Array,
      required: true
    }
  },
  setup() {
    const menuCollapsed = ref(true)
    return { menuCollapsed }
  }
}
</script>