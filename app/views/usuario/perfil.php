<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full  flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full  md:w-3/4  font-dmsans ">
			
			<!-- Perfil columna izquierda -->
			<div class="flex flex-col w-full  md:p-4  space-y-8">

				<div class="w-full rounded-xl h-full bg-white ">

					<div class="flex flex-col   md:p-4 space-y-4 ">


						<!-- perfil Usuario -->
						<div class="p-2 flex flex-col font-dmsans">

						  <div class="w-full flex justify-between py-4 ">
						    <h5 class="w-1/2 text-dark text-2xl font-bold text-neutral"> Perfil de Usuario </h5>
						    <?php echo showAlert(); ?>
						  </div>

						  <form action="<?php echo URLROOT . '/' . $data['controller'] . '/perfil'; ?>" class="py-4" method="post" autocomplete="off" enctype="multipart/form-data">
							  <div class="flex justify-around items-center">
							  	<input type="hidden" name="user_id" value="<?php echo $data['perfil']->tipo_documento ?>">
							  	<?php if($data['perfil']->rol_id == 2 ) : ?>
							  		<?php if (!empty($data['imagenes_perfil'])) : ?>
									    <div class="flex ">
												<img src="<?php echo URLROOT . $data['imagenes_perfil']->imagen_usuario ?>" class="w-32 h-32 rounded-full object-cover bg-primary">
									    </div>

									    <div class="flex flex-col space-y-8 items-center">
												<input type="file" name="imagen" class="bg-cta" required>
									      <div class="mb-6">
										      <button type="submit" name="update_imagen_perfil" class=" p-2 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Actualizar imagen</button>
										    </div>
									    </div>
							  		<?php else: ?>
									    <div class="flex ">
												<img src="<?php echo URLROOT . '/img/user.png' ?>" class="w-32 h-32 rounded-full object-cover bg-primary">
									    </div>

									    <div class="flex flex-col space-y-8 items-center">
												<input type="file" name="imagen" class="bg-cta" required>
									      <div class="mb-6">
										      <button type="submit" name="create_imagen_perfil" class=" p-2 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Subir imagen</button>
										    </div>
									    </div>
							  		<?php endif; ?>

							    <?php endif; ?>	
							  </div>
						  </form>

						  <form action="<?php echo URLROOT . '/' . $data['controller'] . '/perfil'; ?>" id="form_register" method="post" autocomplete="off" >

							  <div class="group-row">
							    <div class="group-col">
							    	<label for="tipo_documento">Tipo de documento:</label>
								    <input type="text" id="tipo_documento" name="tipo_documento" class="bg-primary" value="<?php echo $data['perfil']->tipo_documento ?>" disabled>
							    </div>
							    <div class="group-col relative">
							    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
								    <label for="num_documento">Numero Documento: 
								    	<span id="alert-doc" class="hidden italic text-sm text-red">Maximo <span id="chars_text">2</span> caracteres</span>
								    </label>
								    <input type="text" id="num_documento" name="num_documento"  minlength="3" class="bg-primary"  value="<?php echo $data['perfil']->num_documento ?>" disabled>
							    </div>
							  </div>

							  <div class="group-row">
							    <div class="group-col relative">
							    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
								    <label for="nombre">Nombre:
								    	<span id="alert-nombre" class="hidden italic text-sm text-red">Minimo 3 caracteres</span>
								    </label>
								    <input type="text" id="nombre" name="nombre" minlength="3" required value="<?php echo $data['perfil']->nombre ?>">
							    </div>
							    <div class="group-col relative">
							    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
								    <label for="apellido">Apellido:
								    	<span id="alert-apellido" class="hidden italic text-sm text-red">Minimo 3 caracteres</span>
								    </label>
								    <input type="text" id="apellido" name="apellido" minlength="3" required value="<?php echo $data['perfil']->apellido ?>">	
							    </div>
							  </div>

							  <div class="group-row">
							    <div class="group-col relative">
							  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
								    <label for="telefono">Teléfono:
								    	<span id="alert-telef" class="hidden italic text-sm text-red">Minimo 8 números</span>

								    </label>
								    <input type="text" id="telefono" name="telefono" minlength="8" maxlength="10" value="<?php echo $data['perfil']->telefono ?>" required>
							    </div>
							    <div class="group-col relative">
							  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
								    <label for="email"> E-mail:
								    	<span id="alert-email" class="hidden italic text-sm text-red">Email inválido.</span>

								    </label>
								    <input type="email" id="email" name="email" class="bg-primary" value="<?php echo $data['perfil']->email ?>" required disabled>	
							    </div>
							  </div>

						    <div class="flex flex-col space-y-4 mb-6">
						    	<p class="text-red italic"> * Para cambios de Documento o Email debe comunicarse con el Administrador. </p>
						      <button type="submit" name="update_perfil" class="w-1/2 p-2 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Actualizar Perfil</button>
						    </div>

						  </form>
						</div>


					  <!-- change password  -->
			      <form id="change_form" class="w-1/2 p-2 flex flex-col font-dmsans" action="<?php echo URLROOT . '/' . $data['controller'] . '/perfil'; ?>" method="post">
			        
			        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']  ?>">

			        <div class="border-t-4 border-neutral py-4 ">
			          <h5 class="text-dark text-xl font-bold "> Actualizar Contraseña. </h5>
			        </div>

			        <div  class="flex flex-col mb-6 space-y-1 relative">
			          <div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>

			          <label for="email" class="text-neutralDark">Nueva Contraseña:
			            <span id="alert-pass" class="hidden italic text-sm text-red">Minimo 6 caracteres</span>
			          </label>
			          <div class=" flex border-b border-neutral items-center space-x-4 px-4 ">
			            <i class="fas fa-key text-neutral "></i>
			            <input type="password" id="contrasenia" name="contrasenia" class="w-full outline-none p-2 focus:bg-primary  "  required>
			          </div>
			        </div>

			        <div  class="flex flex-col mb-6 space-y-1 relative">
			          <div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
			          <label for="email" class="text-neutralDark">Repetir Nueva contraseña:
			            <span id="alert-rpass" class="hidden italic text-sm text-red">No coinciden</span>
			          </label>
			          <div class=" flex border-b border-neutral items-center space-x-4 px-4 ">
			            <i class="fas fa-key text-neutral "></i>
			            <input type="password" id="repetirContrasenia" name="repetirContrasenia" class="w-full outline-none p-2 focus:bg-primary  "  required>
			          </div>
			        </div>


			        <div class="mb-6">
			          <button type="submit" name="change_password" class="w-1/2 p-2 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Actualizar Contraseña</button>
			        </div>

			      </form>  


					</div>
				</div>


			</div>


		
		</div>

	</div>
</div>

<?php 

// echo "<pre>";
// print_r($data['perfil']);
// print_r($data['imagenes_perfil']);
// echo "</pre>";

 ?>



<script >
	window.addEventListener('DOMContentLoaded', ()=> { 

		const allBtnClose = document.querySelectorAll('.btn_close')
	  allBtnClose.forEach( btn => {
	    btn.addEventListener('click', () => {
	      let active_modal = document.querySelector('.active-modal')
	      active_modal.classList.toggle('active-modal')
	      active_modal.classList.toggle('hidden')
	    })
	  })

	}) // end DOMcontentLoaded

	const modal_Add = document.querySelector('#modal_add')
	const btn_Add = document.querySelector('#btn_add')
	btn_Add?.addEventListener('click', () => {
	  modal_Add.classList.toggle('hidden')
	  modal_Add.classList.toggle('active-modal')
	  // console.log(modal_Add)
	})

	window.addEventListener('click', (e) => {
	  let activeModal = document.querySelector('.active-modal')
	  if (e.target == activeModal) {
	    activeModal.classList.toggle('active-modal')
	    activeModal.classList.toggle('hidden')
	  }
	})

	if ( window.history.replaceState ) {
	  window.history.replaceState( null, null, window.location.href );
	}

	// change password
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


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 