<?php require APPROOT . '/views/pages/partials/header.php'; ?>

  <!-- flex form section -->
  <section id="form_login" class="h-screen flex flex-col items-center">
    
    <div class="absolute top-20 rounded-md bg-white px-8 py-6 mx-4 drop-shadow-md md:w-96">
      <!-- form login -->
      <form id="change_form" class="flex flex-col font-dmsans" action="<?php echo URLROOT . '/' . $data['controller'] . '/change_password/' . $data['token'] ?>" method="post">
        
        <input type="hidden" name="email" value="<?php echo (isset($data['email'])) ? $data['email'] : '';  ?>">

        <div class="mb-10 space-y-2 md:mb-6 flex flex-col items-center">
          <img class="h-32 object-cover" src="<?php echo URLROOT; ?>/img/logo.png" alt="">
          <h5 class="mx-6 text-dark text-xl font-bold text-center">
            Crea tu nueva contraseña.
          </h5>
          
        </div>

        <div  class="flex flex-col mb-6 space-y-1 relative">
          <div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>

          <label for="email" class="text-neutralDark">Contraseña:
            <span id="alert-pass" class="hidden italic text-sm text-red">Minimo 6 caracteres</span>
          </label>
          <div class=" flex border-b border-neutral items-center space-x-4 px-4 ">
            <i class="fas fa-key text-neutral "></i>
            <input type="password" id="contrasenia" name="contrasenia" class="w-full outline-none p-2 focus:bg-primary  " placeholder="Escribe tu contraseña" required>
          </div>
        </div>

        <div  class="flex flex-col mb-6 space-y-1 relative">
          <div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
          <label for="email" class="text-neutralDark">Repite tu contraseña:
            <span id="alert-rpass" class="hidden italic text-sm text-red">No coinciden</span>
          </label>
          <div class=" flex border-b border-neutral items-center space-x-4 px-4 ">
            <i class="fas fa-key text-neutral "></i>
            <input type="password" id="repetirContrasenia" name="repetirContrasenia" class="w-full outline-none p-2 focus:bg-primary  " placeholder="Repite la contraseña" required>
          </div>
        </div>


        <div class="mb-6">
          <button type="submit" class="w-full p-3 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Cambiar Contraseña</button>
        </div>

        <div class=" flex items-center text-center mx-auto md:w-1/2">
          <a class="p-3  bg-neutral text-white hover:bg-neutralDark w-full rounded-full " href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>"> Cancelar </a>
        </div>

        
      </form>     
    </div>
  </section>




<script>
  
const form = document.querySelector('#change_form')
form.addEventListener('submit', e => {
  if(form.classList.contains('invalid')) {
    e.preventDefault()
    // console.log(form)
  } 
})


const passValidation = (value) => {
  let i = 0

  if(value.length > 5) {
    i++
  }

  if(/[A-Z]/.test(value)) {
    i++
  }

  if(/[1-9]/.test(value)) {
    i++
  }

  if(/[A-Za-z0-3]/.test(value)) {
    i++
  }

  return i
}


const pass = document.querySelector('#contrasenia')
pass.addEventListener('keyup', (e) => {

  let passValid = passValidation(pass.value)
  const alertPass = document.querySelector('#alert-pass')
  // console.log(numDoc.value.length)

  if(passValid === 4) {
    alertPass.classList.add('hidden')
    alertPass.parentElement.previousElementSibling.classList.remove('hidden')
  } else {
    alertPass.classList.remove('hidden')
    alertPass.parentElement.previousElementSibling.classList.add('hidden')
  }


})

const rpass = document.querySelector('#repetirContrasenia')
rpass.addEventListener('keyup', (e) => {

  const alertRpass = document.querySelector('#alert-rpass')
  // console.log(numDoc.value.length)
  if (rpass.value.length > 3) {
    if(rpass.value == pass.value) {
      alertRpass.classList.add('hidden')
      alertRpass.parentElement.previousElementSibling.classList.remove('hidden')
      form.classList.remove('invalid')
      // console.log(form)
    } else {
      alertRpass.classList.remove('hidden')
      alertRpass.parentElement.previousElementSibling.classList.add('hidden')
      form.classList.add('invalid')

    }

  }

})


</script>
<?php require APPROOT . '/views/pages/partials/footer.php'; ?>