<template>
  <section class="container">
    <h1>About</h1>
    <h3>Les personnages envoyés par mail ({{characters.length}} envoyés)</h3>
    <p>(fichier dans le dossier 'assets/app/pages/About')</p>
    <div class="row">
    <card class="col-xs-12 col-sm-6 col-md-4 p-1" :character="character" v-for="(character, index) in characters" :showButton="false" :key="index"/>
    </div>
  </section>
</template>
<script>
import {useCharacterState} from '../../composition/use-character-state'
import Card from '../../components/Card'

export default {
  components: {
    Card
  },
  setup() {
    const {savedCharacters: characters} = useCharacterState()
    return {characters}
  }
}
</script>