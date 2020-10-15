<template>
  <section class="container">
    <h1>About</h1>
    <h3>Les personnages envoyés par mail ({{savedCharacters.length}} envoyés)</h3>
    <p>(fichier dans le dossier 'assets/app/pages/About')</p>
    <div class="row mt-3 mb-3">
      <form class="form">
        <input type="text" class="form" v-model="search">
      </form>
    </div>
    <div class="row">
      <card class="col-xs-12 col-sm-6 col-md-4 p-1" :character="character" v-for="(character, index) in filteredCharacters" :showButton="false" :key="index"/>
    </div>
  </section>
</template>
<script>
import {computed, ref} from 'vue'
import {useCharacterState} from '../../composition/use-character-state'
import Card from '../../components/Card'

export default {
  components: {
    Card
  },
  setup() {
    const search = ref('')
    const {savedCharacters} = useCharacterState()
    const filteredCharacters = computed( () => {
      return savedCharacters.value.filter( savedCharacter => savedCharacter.name.toLowerCase().includes(search.value.toLowerCase()) )
    })
    return {search, filteredCharacters, savedCharacters}
  }
}
</script>