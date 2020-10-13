<template>
  <section class="container">
  <h1>Home</h1>
  <h3>Quelques personnages aléatoires ({{savedCharacters.length}} enregistrés)</h3>
  <p>(fichier dans le dossier 'assets/app/pages/Home')</p>
    <div class="row">
    <card class="col-xs-12 col-sm-6 col-md-4 p-1" :character="character" v-for="(character, index) in characters" :key="index" @buttonClicked="saveAndSendCharacterMail"/>
    </div>
  </section>
</template>
<script>
import axios from 'axios'
import {onMounted, ref} from 'vue'
import {useRandom} from '../../composition/use-random'
import {useCharacterState} from '../../composition/use-character-state'
import Card from '../../components/Card'

export default {
  components: {
    Card
  },
  setup() {
    const characters = ref([])
    const {getRandomIntBetween, getRandomIntArray} = useRandom()
    const {savedCharacters, addCharacter} = useCharacterState()
    const updateListe = () => {
      let ids = getRandomIntArray(getRandomIntBetween(4, 16), 200)
      axios.get( 'https://rickandmortyapi.com/api/character/' + ids.join() )
      .then(chars => {
        characters.value = chars.data
      })
    }
    const saveAndSendCharacterMail = (character) => {
      axios.post('/sendmail', character)
      .then(response => {
        if(response.status == 200) {
          addCharacter(character)
        }
      })
    }
    onMounted(() => {
      updateListe()
    })
    return {characters, saveAndSendCharacterMail, savedCharacters}
  }
}
</script>