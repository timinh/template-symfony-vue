<template>
  <section class="container">
  <h1>GraphQL</h1>
  <h3>Personnages récupérés via GraphQL ({{savedCharacters.length}} enregistrés)</h3>
  <p>(fichier dans le dossier 'assets/app/pages/GraphQL')</p>
    <div class="row">
      <input type="text" placeholder="Chercher..." v-model="search" @input="fetchCharacters()"/>
    </div>
    <div v-if="characters.length>0" class="row">
      <card class="col-xs-12 col-sm-6 col-md-4 p-1" :character="character" v-for="(character, index) in characters" :showButton="isActive(character)" :key="index" @buttonClicked="sendCharacterByMail"/>
    </div>
    <div v-else class="row">
      il n'y a pas de personnage avec ce nom
    </div>
  </section>
</template>
<script>
import {useCharacterState} from '../../composition/use-character-state'
import {useMail} from '../../composition/use-mail'
import Card from '../../components/Card'
import { onMounted, ref } from 'vue'
export default {
  components: {
    Card
  },
  setup() {
    const characters = ref([])
    const search = ref('')
    const {savedCharacters} = useCharacterState()
    const {sendCharacterByMail} = useMail(2)

    const query = `
      query findCharacters($name: String) {
        characters(filter: { name: $name }) {
          results {
            id
            name
            species
            gender
            origin {
              name
            }
            image
          }
        }
      }
    `
    const fetchCharacters = async () => {
     await fetch(process.env.graphql_endpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          query,
          variables: {
            name: search.value
          }
        })
      })
      .then(response => response.json())
      .then(data => {
        characters.value = data.data.characters.results
      })
      .catch( msg => characters.value = [] )
    }
    
    const isActive = (character) => {
      return !savedCharacters.value.some( char => char.id == character.id)
    }

    onMounted( () => {
      fetchCharacters()
    })

    return {characters, savedCharacters, fetchCharacters, sendCharacterByMail, isActive, search}
  }
}
</script>