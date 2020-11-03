<template>
  <figure ref="root">
    <transition name="fade" mode="out-in">
    <img ref="refImg" v-if="intersected"
      v-show="imgLoaded"
      :alt="alt"
      :src="imageSrc"
      :class="classes"
      @load="imgLoaded = true"
    >
    </transition>
    <div class="loader" v-if="!imgLoaded"></div>
  </figure>
</template>
<script>
import { reactive, onMounted, toRefs, ref, computed } from 'vue';
export default {
  name: "ImageItem",
  props: {
    source: { type: String, required: false },
    alt: { type: String, required: false, default: ''},
    classes: {type: String, required: false, default: ''}
  },
  setup(props, context) {
    const root = ref(null)

    const state = reactive({
      observer: null,
      intersected: false,
      imgLoaded: false
    })

    onMounted( () => {
      state.observer = new IntersectionObserver(([entry]) => {
        if(entry.intersectionRatio > 0) {
          state.intersected = true
          state.observer.unobserve(entry.target)
        }
      })
      state.observer.observe(root.value)
    })
    const imageSrc = computed( () => {
      return state.intersected ? props.source : ''
    })
    
    return { ...toRefs(state), root, imageSrc }
  }
};
</script>