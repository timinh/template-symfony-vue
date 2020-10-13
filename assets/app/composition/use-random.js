export function useRandom() {
  const getRandomIntBetween = (min, max) => {
    return Math.floor(Math.random() * (max - min + 1)) + min
  }

  const getRandomIntArray = (num, max) => {
    let liste = []
    for(let i=0;i<num;i++) {
      liste.push(Math.floor(Math.random() * (max - 1 + 1)) + 1)
    }
    return liste
  }

  return { getRandomIntBetween, getRandomIntArray }
}