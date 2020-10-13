import {reactive, toRefs} from 'vue'

const state = reactive({
  savedCharacters: []
})

export function useCharacterState() {

  const addCharacter = (c) => {
    state.savedCharacters.push(c)
  }

  return {...toRefs(state), addCharacter}
}