<?php require APPROOT . '/views/pages/partials/header.php'; ?>

  <!-- flex form section -->
  <section id="form_login" class="h-screen flex flex-col items-center">
    
    <div class="absolute top-20 rounded-md bg-white px-8 py-6 mx-4 drop-shadow-md md:w-96">
      <!-- form login -->
      <form class="flex flex-col font-dmsans" action="<?php echo URLROOT . '/' . $data['controller'] . '/forgot' ?>" method="post">
        

        <div class="mb-10 space-y-2 md:mb-6 flex flex-col items-center">
          <img class="h-32 object-cover" src="<?php echo URLROOT; ?>/img/logo.png" alt="">
          <h5 class="mx-6 text-dark text-xl font-bold text-center">
            Te enviaremos un email para recuperar tu contraseña.
          </h5>
          <?php showAlert(); ?>
          
        </div>

        <div  class="flex flex-col mb-6 space-y-1">
          <label for="email" class="text-neutralDark">Ingresa tu Email</label>
          <div class=" flex border-b border-neutral items-center space-x-4 px-4 ">
            <i class="fas fa-envelope text-neutral "></i>
            <input id="email" type="email" name="email" class="w-full outline-none p-2 focus:bg-primary  " placeholder="Ingrese su Email" required>
          </div>
        </div>


        <div class="mb-6">
          <button type="submit" class="w-full p-3 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Enviar Email</button>
        </div>

        <div class=" flex items-center text-center mx-auto mb-3 md:w-1/2">
          <a class="p-3  bg-neutral text-white hover:bg-neutralDark w-full rounded-full " href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>"> Cancelar </a>
        </div>

        
      </form>     
    </div>
  </section>



<?php require APPROOT . '/views/pages/partials/footer.php'; ?>