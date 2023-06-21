// window.addEventListener('DOMContentLoaded', () => {
//   Swal.fire({
//   title: 'Error!',
//   text: 'Do you want to continue',
//   icon: 'error',
//   confirmButtonText: 'Cool'
// })

//   Swal.fire({
//   icon: 'info',
//   title: '<a href="">Why do I have this issue?</a>',
//   text: 'Something went wrong!',
//   footer: '<a href="">Why do I have this issue?</a>'
// })

// Swal.fire({
//   title: '<a href="//192.168.8.100/board.nicedev90.pro/BeautyWayPhp/pages/login">Debes Iniciar Sesion</a> ',
//   icon: 'info',
// })

// Swal.fire({
//   position: 'top-end',
//   icon: 'success',
//   title: 'Your work has been saved',
//   showConfirmButton: false,
//   timer: 1500
// })


// })



// cargar imagen con javascript
const inputImage = document.getElementById('img-input')
inputImage.type = 'file'
inputImage.accept = 'image/*'

inputImage.addEventListener('change', fileEvent => {
  const file = fileEvent.target.files[0]
  const reader = new FileReader()

  reader.addEventListener('load', readerEvent => {
    const image = new Image()
    image.addEventListener('load', drawImage)
    image.src = readerEvent.target.result;
  })

  reader.readAsDataURL(file, "UTF-8")
})


// funcion para dibujar la imagen, arrow function no es una opción porque no permite usar "this", fuera del scope del objeto
function drawImage() {
  const preview = document.getElementById('preview')
  const ctx = preview.getContext('2d')

  // this es la imagen que carga con el evento "onload"
  preview.width = this.naturalWidth;
  preview.height = this.naturalHeight;
  ctx.drawImage(this, 0, 0, this.width, this.height);
}
