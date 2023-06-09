<?php require APPROOT . '/views/pages/partials/header.php'; ?>

  <!-- flex form section -->
  <section class="h-screen flex flex-col items-center">
    
    <div class="absolute top-20 rounded-md bg-white px-8 py-6 mx-4 drop-shadow-md md:w-1/3">

      <div class="flex flex-col items-center space-y-5 text-center py-5 font-dmsans">
        <h2 class="text-2xl text-neutral font-bold">Email enviado a : </h2>
        <p class="w-full text-2xl text-white p-2 text-dark bg-neutral"> <?php echo isset($data['email']) ? $data['email'] : '' ?></p> 
        <p>Revisa tu bandeja de entrada e ingresa al link que te enviamos para cambiar tu contraseña</p>

        <div class=" flex items-center text-center mx-auto w-3/4">
          <a class="p-3  bg-cta text-dark font-bold text-xl  hover:bg-ctaDark w-full rounded-full " href="<?php echo URLROOT . '/pages/login' ?>"> Ir a Iniciar Sesion </a>
        </div>

      </div>

    </div>
  </section>


<?php require APPROOT . '/views/pages/partials/footer.php'; ?>