import axios from 'axios'
import {useNotifications} from './use-notifications'
import {useCharacterState} from './use-character-state'

export function useMail(typeChar=1) {
  const {addNotification} = useNotifications()
  const {addCharacter} = useCharacterState()

  const sendCharacterByMail = async(character) => {
    character.type = parseInt(typeChar)
    try {
      await axios.post(process.env.base_url+'/sendmail', character)
      .then(response => {
        if(response.status == 200) {
          addCharacter(character)
          addNotification({
            message: response.data,
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

  return {sendCharacterByMail}
}