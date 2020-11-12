<template>
  <section class="container">
  <h1>Home</h1>
  <h3>Quelques personnages aléatoires récupérés via api rest ({{savedCharacters.length}} enregistrés)</h3>
  <p>(fichier dans le dossier 'assets/app/pages/Home')</p>
    <div class="row">
    <card class="col-xs-12 col-sm-6 col-md-4 p-1" :character="character" v-for="(character, index) in characters" :showButton="isActive(character)" :key="index" @buttonClicked="sendCharacterByMail"/>
    </div>
  </section>
</template>
<script>
import axios from 'axios'
import {onMounted, ref} from 'vue'
import {useRandom} from '../../composition/use-random'
import {useCharacterState} from '../../composition/use-character-state'
import {useMail} from '../../composition/use-mail'
import Card from '../../components/Card'

export default {
  components: {
    Card
  },
  setup() {
    const characters = ref([])
    const {getRandomIntBetween, getRandomIntArray} = useRandom()
    const {savedCharacters} = useCharacterState()
    const {sendCharacterByMail} = useMail()

    const updateListe = () => {
      let ids = getRandomIntArray(getRandomIntBetween(4, 16), 200)
      axios.get( process.env.api_endpoint + '/character/' + ids.join() )
      .then(chars => {
        characters.value = chars.data
      })
    }

    const isActive = (character) => {
      return !savedCharacters.value.some( char => char.id == character.id)
    }
    onMounted(() => {
      updateListe()
    })
    return {characters, sendCharacterByMail, savedCharacters, isActive}
  }
}
</script>