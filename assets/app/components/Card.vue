<template>
  <div class="card" style="width: 18rem;">
    <!-- <img :src="character.image" class="card-img-top" alt="" /> -->
    <!-- avec mise en case du stream sur le disque -->
    <image-item :source="base_url+'/images/stream/'+character.id+'.jpeg'" classes="card-img-top" :alt="character.name" />
    <div class="card-body">
      <h5 class="card-title">{{character.name}}</h5>
      <p class="card-text">Espèce : {{character.species}}</p>
      <p class="card-text">Genre : {{character.gender}}</p>
      <p class="card-text">Origine : {{character.origin.name}}</p>
      <button v-if="showButton" class="btn btn-primary" @click="clickButton">Recevoir par mail</button>
    </div>
  </div>
</template>
<script>
import ImageItem from './ImageItem'
export default {
  name: 'Card',
  props: {
    character: {
      type: Object,
      require: true
    },
    showButton: {
      type: Boolean,
      require: false,
      default: true
    }
  },
  components: {
    ImageItem
  },
  setup(props,{emit}){
    const clickButton = () => {
      emit('buttonClicked', props.character)
    }
    const base_url = process.env.base_url

    return { clickButton, base_url }
  }
}
</script>