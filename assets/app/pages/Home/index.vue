<template>
  <section class="container">
  <h1>Home</h1>
    <div class="row">
    <card class="col-xs-12 col-sm-6 col-md-4 p-1" :character="character" v-for="(character, index) in characters" :key="index" @buttonClicked="sendMail"/>
    </div>
  </section>
</template>
<script>
import axios from 'axios'
import {onMounted, ref} from 'vue'
import {useRandom} from '../../composition/use-random'
import Card from '../../components/Card'

export default {
  components: {
    Card
  },
  setup() {
    const characters = ref([])
    const {getRandomIntBetween, getRandomIntArray} = useRandom()
    const updateListe = () => {
      let ids = getRandomIntArray(getRandomIntBetween(4, 16), 200)
      axios.get( 'https://rickandmortyapi.com/api/character/' + ids.join() )
      .then(chars => {
        characters.value = chars.data
      })
    }
    const sendMail = (character) => {
      axios.post('/sendmail', character)
      .then(response => {
        console.log(response.status)
      })
    }
    onMounted(() => {
      updateListe()
    })
    return {characters, sendMail}
  }
}
</script>