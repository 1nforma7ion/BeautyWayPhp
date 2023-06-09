<?php require APPROOT . '/views/pages/partials/header.php'; ?>



  <!-- flex form section -->
  <section id="form_login" class="h-screen flex flex-col items-center">
    
    <div class="absolute top-20 rounded-md bg-white px-8 py-6 mx-4 drop-shadow-md md:w-96">
      <!-- form login -->
      <form class="flex flex-col" action="<?php echo URLROOT; ?>/pages/login" method="post" autocomplete="off" >
        
        <div class="mb-10 space-y-2 md:mb-6 flex flex-col items-center">
          <img class="h-32 object-cover" src="<?php echo URLROOT; ?>/img/logo.png" alt="">
          <?php if(isset($data['error'])) : ?>
          <div class="w-full p-2 bg-neutral text-center text-lg text-dark">
             <?php echo $data['error']; ?>
          </div>
          <?php endif; ?>
          <?php showAlert(); ?>
        </div>

        <div id="user-group" class="relative flex flex-col mb-6 space-y-1">

          <label for="email" class="text-neutralDark">Email</label>
          <div class="flex border-b focus:border-b-4  border-neutral items-center space-x-4 px-4 ">
            <i class="fa-solid fa-user text-neutral fa-1x"></i>
            <input id="email" type="text" name="email" class="w-full outline-none p-2 " placeholder="Ingrese su correo" required>
          </div>
        </div>

        <div id="pass-group" class="relative flex flex-col mb-6 space-y-1">

          <label for="password" class="text-neutralDark">Contraseña</label>          
          <div class="flex border-b focus:border-b-4  border-neutral  items-center space-x-4 px-4 ">
            <i class="fa-solid fa-key text-neutral fa-1x"></i>
            <input id="password" type="password" name="password" class="w-full outline-none p-2 " placeholder="Ingrese su contraseña" required>
          </div>
        </div>

        <div class="mb-6">
          <button type="submit" class="w-full p-3 text-xl rounded-md font-bold text-dark border-4 border-ctaDark bg-ctaLight hover:bg-ctaDark">Iniciar Sesión</button>
        </div>

        <a class="p-3 flex items-center hover:border-b-2 hover:border-white" href="<?php echo URLROOT . '/' . $data['controller'] . '/registrar' ?>"> Registrar </a>
        
      </form>     
    </div>
  </section>



<?php require APPROOT . '/views/pages/partials/footer.php'; ?>