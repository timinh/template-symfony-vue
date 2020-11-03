<template>
  <section class="container">
  <h1>Home</h1>
  <h3>Quelques personnages aléatoires ({{savedCharacters.length}} enregistrés)</h3>
  <p>(fichier dans le dossier 'assets/app/pages/Home')</p>
    <div class="row">
    <card class="col-xs-12 col-sm-6 col-md-4 p-1" :character="character" v-for="(character, index) in characters" :showButton="isActive(character)" :key="index" @buttonClicked="saveAndSendCharacterMail"/>
    </div>
  </section>
</template>
<script>
import axios from 'axios'
import {onMounted, ref} from 'vue'
import {useRandom} from '../../composition/use-random'
import {useCharacterState} from '../../composition/use-character-state'
import {useNotifications} from '../../composition/use-notifications'
import Card from '../../components/Card'

export default {
  components: {
    Card
  },
  setup() {
    const characters = ref([])
    const {getRandomIntBetween, getRandomIntArray} = useRandom()
    const {savedCharacters, addCharacter} = useCharacterState()
    const {addNotification} = useNotifications()

    const updateListe = () => {
      let ids = getRandomIntArray(getRandomIntBetween(4, 16), 200)
      axios.get( 'https://rickandmortyapi.com/api/character/' + ids.join() )
      .then(chars => {
        characters.value = chars.data
      })
    }
    const saveAndSendCharacterMail = async(character) => {
      try {
      await axios.post('/sendmail', character)
      .then(response => {
        if(response.status == 200) {
          addCharacter(character)
          addNotification({
            message: 'La fiche : ' + character.name + ' vous a été envoyée par email',
            type: "success"
          })
        } else {
          addNotification({
            message: 'Le mail n\'a pas pu être envoyé ',
            type: "danger"
          })
        }
      })
      } catch (error) {
        addNotification({
          message: 'Le mail n\'a pas pu être envoyé ',
          type: "danger"
        })
      }
      
    }
    const isActive = (character) => {
      return !savedCharacters.value.some( char => char.id == character.id)
    }
    onMounted(() => {
      updateListe()
    })
    return {characters, saveAndSendCharacterMail, savedCharacters, isActive}
  }
}
</script>