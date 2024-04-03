const squares = document.querySelectorAll('.square')
const mole = document.querySelector('.mole')
const timeLeft = document.querySelector('#time-left')
const score = document.querySelector('#score')
const difficultyButton = document.querySelector('#difficulty-button')

let result = 0
let hitPosition
let currentTime = 60
let timerId = null
let difficulty = 'simple'

function randomSquare() {
  squares.forEach(square => {
    square.classList.remove('mole')
  })

  let randomSquare = squares[Math.floor(Math.random() * 9)]
  randomSquare.classList.add('mole')

  hitPosition = randomSquare.id
}

squares.forEach(square => {
  square.addEventListener('mousedown', () => {
    if (square.id == hitPosition) {
      result++
      score.textContent = result
      hitPosition = null
    }
  })
})

function moveMole() {
  if (difficulty === 'simple') {
    timerId = setInterval(randomSquare, 1000)
  } else if (difficulty === 'hard') {
    timerId = setInterval(randomSquare, 500)
  }
}

moveMole()

function countDown() {
 currentTime--
 timeLeft.textContent = currentTime

 if (currentTime == 0) {
   clearInterval(countDownTimerId)
   clearInterval(timerId)
   alert('GAME OVER! Your final score is ' + result)
 }

}

let countDownTimerId = setInterval(countDown, 1000)

difficultyButton.addEventListener('click', () => {
  if (difficulty === 'simple') {
    difficulty = 'hard'
    difficultyButton.textContent = 'Hard'
    clearInterval(timerId)
    moveMole()
  } else if (difficulty === 'hard') {
    difficulty = 'simple'
    difficultyButton.textContent = 'Simple'
    clearInterval(timerId)
    moveMole()
  }
})
