const slidesMobile = document.querySelectorAll('.slide-mobile')
slidesMobile.forEach((slide, index) => {
  slide.style.transform = `translateX(${index * 100}%)`
})

let totalSlidesMobile = slidesMobile.length -1
let currentSlideMobile = 0

const nextBtnMobile = document.querySelector('#next-mobile')
nextBtnMobile?.addEventListener('click', () => {
  if(currentSlideMobile === totalSlidesMobile) {
    currentSlideMobile = 0
  } else {
    currentSlideMobile++
  }

  slidesMobile.forEach((slide, index) => {
    slide.style.transform = `translateX(${100 * (index - currentSlideMobile)}%)`
  })
})

const prevBtnMobile = document.querySelector('#prev-mobile')
prevBtnMobile?.addEventListener('click', () => {
  if(currentSlideMobile === 0) {
    currentSlideMobile = maxSlide
  } else {
    currentSlideMobile--
  }

  slidesMobile.forEach((slide, index) => {
    slide.style.transform = `translateX(${100 * (index - currentSlideMobile)}%)`
  })
})


const slides = document.querySelectorAll('.slide')
slides.forEach((slide, index) => {
  slide.style.transform = `translateX(${index * 100}%)`
})

let maxSlide = slides.length -1
let currentSlide = 0

const nextBtn = document.querySelector('#next')
nextBtn?.addEventListener('click', () => {

  if(currentSlide === maxSlide) {
    currentSlide = 0
  } else {
    currentSlide++
  }

  slides.forEach((slide, index) => {
    slide.style.transform = `translateX(${100 * (index - currentSlide)}%)`
  })
})

const prevBtn = document.querySelector('#prev')
prevBtn?.addEventListener('click', () => {
  if(currentSlide === 0) {
    currentSlide = maxSlide
  } else {
    currentSlide--
  }

  slides.forEach((slide, index) => {
    slide.style.transform = `translateX(${100 * (index - currentSlide)}%)`
  })
})

