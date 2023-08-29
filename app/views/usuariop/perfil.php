<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full  flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full  md:w-3/4  font-dmsans ">
			
			<!-- Perfil columna izquierda -->
			<div class="flex flex-col w-2/3  md:p-4  space-y-8">

				<div class="w-full rounded-xl h-full bg-white ">

					<div class="flex flex-col   md:p-4 space-y-4 ">

						<!-- perfil comercial -->
						<div class="p-2 flex flex-col font-dmsans">
							
				      <div class=" pb-4 ">
			          <h5 class="text-dark text-2xl font-bold text-neutral"> Perfil Comercial </h5>
						    <?php echo showMsg(); ?>
			        </div>

							<form action="<?php echo URLROOT . '/' . $data['controller'] . '/perfil'; ?>" id="form_register" method="post" autocomplete="off" >

								<div class="group-col relative">
									<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
							    <label for="nombre_comercial">Nombre Comercial:
							    	<span id="alert-comercial" class="hidden italic text-sm text-red">Minimo 6 caracteres</span>
							    </label>
							    <input type="text" id="nombre_comercial" name="nombre_comercial" value="<?php echo $data['perfil']->nombre_comercial ?>">
								</div>

							  <div class="group-row">

									<div class="group-col">
								    <label for="modalidad">Modalidad de Trabajo:</label>
								    <select id="modalidad" name="modalidad">
								 			<option selected class="bg-cta" value="<?php echo $data['perfil']->modalidad ?>"><?php echo $data['perfil']->modalidad ?></option>
								     	<?php if(isset($data['modalidades'])) : ?>
												<?php foreach ($data['modalidades'] as $row) : ?>												
												<option value="<?php echo $row->modalidad ?>"><?php echo $row->modalidad ?></option>
												<?php endforeach; ?>
											<?php endif; ?> 
								    </select>
								  </div>

									<div class="group-col">
								    <label for="zona">Zona de Trabajo:</label>
								    <select id="zona" name="zona">
								    	<option selected class="bg-cta" value="<?php echo $data['perfil']->id_zona_trabajo ?>"><?php echo $data['perfil']->zona ?></option>
								     	<?php if(isset($data['zonas'])) : ?>
												<?php foreach ($data['zonas'] as $row_zona) : ?>
												<option value="<?php echo $row_zona->id ?>"><?php echo $row_zona->zona ?></option>
												<?php endforeach; ?>
											<?php endif; ?> 
								      
								    </select>
								  </div>

							  </div>


							  <div class="w-full flex space-x-8 mb-4">
							    <div class="group-col relative w-1/3">
							    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
							  		<label for="calle">Calle:
								    	<span id="alert-calle" class="hidden italic text-sm text-red">Minimo 4 caracteres</span>
							  		</label>
							    	<input type="text" id="calle" name="calle" required value="<?php echo $data['perfil']->calle ?>">
							    </div>
							    <div class="group-col relative w-1/3">
							    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
								    <label for="altura">Altura:
								    	<span id="alert-altura" class="hidden italic text-sm text-red">Minimo 2 números</span>
								  	</label>
								    <input type="number" id="altura" name="altura" min="1" max="9999" required value="<?php echo $data['perfil']->altura ?>">
							    </div>
							    <div class="group-col w-1/3">
							   		<label for="piso">Piso: (Opcional)</label>
							    	<input type="text" id="piso" name="piso" maxlength="5" value="<?php echo $data['perfil']->piso ?>">
							    </div>
							  </div>

							  <div class="w-full flex space-x-8 mb-4">

							    <div class="group-col w-1/3">
								    <label for="depto">Depto.: (Opcional)  </label>
								    <input type="text" id="depto" name="depto" value="<?php echo $data['perfil']->depto ?>">
							    </div>
							    <div class="group-col relative w-1/3">
							  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
								    <label for="barrio">Barrio:
								    	<span id="alert-barrio" class="hidden italic text-sm text-red">Minimo 4 caracteres</span>
								    </label>
								    <input type="text" id="barrio" name="barrio" required value="<?php echo $data['perfil']->barrio ?>">
							    </div>

							    <div class="group-col  w-1/3">
								    <label for="localidad">Localidad: </label>
								    <select id="localidad" name="localidad" required>
								    	<option selected class="bg-cta" value="<?php echo $data['perfil']->localidad ?>"><?php echo $data['perfil']->localidad ?></option>
								     	<?php if(isset($data['localidades'])) : ?>
												<?php foreach ($data['localidades'] as $row_localidad) : ?>
												<option value="<?php echo $row_localidad->localidad ?>"><?php echo $row_localidad->localidad ?></option>
												<?php endforeach; ?>
											<?php endif; ?> 
								    </select>
							    </div>

							  </div>

						    <div class="mb-6">
						      <button type="submit" name="update_comercial" class="w-1/2 p-2 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Actualizar Perfil Comercial</button>
						    </div>

							</form>

						</div>

						<!-- perfil Usuario -->
						<div class="p-2 flex flex-col font-dmsans">

						  <div class="border-t-4 border-neutral py-4 ">
						    <h5 class="text-dark text-2xl font-bold text-neutral"> Perfil de Usuario </h5>
						  </div>

						  <form action="<?php echo URLROOT . '/' . $data['controller'] . '/perfil'; ?>" class="py-4" method="post" autocomplete="off" enctype="multipart/form-data">
							  <div class="flex justify-around items-center">
							  	<input type="hidden" name="user_id" value="<?php echo $data['perfil']->tipo_documento ?>">
							  	<?php if($data['perfil']->rol_id == 3 ) : ?>
							  		<?php if (!empty($data['imagenes_perfil'])) : ?>
									    <div class="flex ">
												<img src="<?php echo URLROOT . $data['imagenes_perfil']->imagen_comercial ?>" class="w-32 h-32 rounded-full object-cover bg-primary">
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
								    <input type="email" id="email" name="email" class="bg-primary" value="<?php echo $data['perfil']->email ?>" disabled>	
							    </div>
							  </div>

						    <div class="flex flex-col space-y-4 mb-6">
						    	<p class="text-red italic"> * Para cambios de Documento o Email debe comunicarse con el Administrador. </p>
						      <button type="submit" name="update_perfil" class="w-1/2 p-2 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Actualizar Perfil</button>
						    </div>


						  </form>
						</div>



					  <!-- change password  -->
			      <form id="change_form" class="p-2 flex flex-col font-dmsans" action="<?php echo URLROOT . '/' . $data['controller'] . '/perfil'; ?>" method="post">
			        
			        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']  ?>">

			        <div class="border-t-4 border-neutral py-4 ">
			          <h5 class="text-dark text-xl font-bold "> Actualizar Contraseña. </h5>
			        </div>

			        <div  class="flex flex-col mb-6 space-y-1 relative">
			          <div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>

			          <label for="email" class="text-neutralDark">Nueva Contraseña:
			            <span id="alert-pass" class="hidden italic text-sm text-red">Mínimo 6 caracteres, incluir 1 mayúscula y 1 número</span>
			          </label>
			          <div class=" flex border-b border-neutral items-center space-x-4 px-4 ">
			            <i class="fas fa-key text-neutral "></i>
			            <input type="password" id="contrasenia" name="contrasenia" class="w-full outline-none p-2 focus:bg-primary  "  required>
			          </div>
			        </div>

			        <div  class="flex flex-col mb-6 space-y-1 relative">
			          <div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
			          <label for="email" class="text-neutralDark">Repetir Nueva contraseña:
			            <span id="alert-rpass" class="hidden italic text-sm text-red">Contraseñas no coinciden</span>
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

			<!-- Perfil columna derecha -->
			<div class="w-1/3 flex flex-col space-y-4 md:p-4 ">
			<!-- seccion horarios -->
				<div class="w-full rounded-xl bg-white ">
					<div class="flex flex-col  md:p-4 space-y-4 ">
						<div class="w-full flex justify-between ">
							<h1 class="text-dark text-2xl text-neutral "> Horarios de Atención </h1>
						</div>

						<div class="flex flex-col p-1">
					    <p class="text-neutral "> * Debes agregar Turnos antes de publicar.</p>
					  </div>

						<a href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_turnos' ?>" class="w-max px-4 py-2 bg-ctaDark  cursor-pointer font-bold rounded-xl">
							 <span><i class="fas fa-edit mr-2"></i></span> 
							 <span>Editar Turnos</span> 
						</a>

					</div>
				</div>

			<!-- seccion profesiones -->
				<div class="w-full rounded-xl bg-white ">
					<div class="flex flex-col   md:p-4  space-y-4">

						<div class="w-full flex justify-between ">
							<h1 class="text-dark text-2xl text-neutral "> Profesion(es) </h1>
						</div>
						
						<button id="btn_add" class="w-44 bg-ctaDark  cursor-pointer p-2 font-bold rounded-xl">
							<i class="fas fa-plus mr-2"></i>Agregar Profesion
						</button>

						<div class="flex flex-col p-1">
					    <p class="text-neutral "> * Debes agregar Servicios antes de publicar.</p>
					  </div>

						<div class="flex flex-col ">

				      <?php if(isset($data['profesiones'])) : ?>
		            <?php foreach ($data['profesiones'] as $row) : ?>
									<div class="w-full flex items-center justify-between bg-primary p-1 border-b">
										<div class="space-x-2">
											<i class="fas fa-chevron-right mr-2"></i>
											<span><?php echo $row->profesion ?></span>
										</div>

										<a href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_profesion/' . $row->id_profesion ?>" class="cursor-pointer p-1 text-2xl hover:bg-cta ">
											<i class="fas fa-edit"></i>
										</a>
									</div>
		            <?php endforeach; ?>
		          <?php endif; ?> 
						</div>

					</div>
				</div>

			</div>


		
		</div>

	</div>
</div>

<?php 

echo "<pre>";
// print_r($data['perfil']);
// print_r($data['imagenes_perfil']);
echo "</pre>";

 ?>

<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_add.php'; ?>


<script >
	window.addEventListener('DOMContentLoaded', ()=> { 
		
	 	const successAlert = document.querySelector('#success_msg')
	  	setTimeout(() => {
	    	successAlert?.remove()
	  	}, 5000)

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
  if(form.classList.contains('invalid') || form.classList.contains('invalidp')) {
    e.preventDefault()
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

  if(passValid === 4) {
    alertPass.classList.add('hidden')
    alertPass.parentElement.previousElementSibling.classList.remove('hidden')
      form.classList.remove('invalidp')

  } else {
    alertPass.classList.remove('hidden')
    alertPass.parentElement.previousElementSibling.classList.add('hidden')
    form.classList.add('invalidp')
  }
})

const rpass = document.querySelector('#repetirContrasenia')
rpass.addEventListener('keyup', (e) => {

  const alertRpass = document.querySelector('#alert-rpass')

  if (rpass.value.length > 5) {
    if(rpass.value == pass.value) {
      alertRpass.classList.add('hidden')
      alertRpass.parentElement.previousElementSibling.classList.remove('hidden')
      form.classList.remove('invalid')

    } else {
      alertRpass.classList.remove('hidden')
      alertRpass.parentElement.previousElementSibling.classList.add('hidden')
      form.classList.add('invalid')
    }
  }

})

</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 