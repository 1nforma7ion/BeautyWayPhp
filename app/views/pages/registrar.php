<?php require APPROOT . '/views/pages/partials/header.php'; ?>


  <!-- flex form section -->
  <section class="h-screen flex flex-col items-center md:px-6.5">
    
    <div class="absolute top-10 rounded-md bg-white px-8 py-6 mx-4 drop-shadow-md md:w-3/4">


  <form action="<?php echo URLROOT; ?>/pages/registrar" id="form_register" method="post" autocomplete="off">

		<div class="w-full flex items-center justify-around space-x-8">
			<img class="h-20 object-cover" src="<?php echo URLROOT; ?>/img/logo.png" alt="">
			<h2 class="p-4 text-4xl text-neutral">Formulario de Registro</h2>
			<div id="btn-pro" class="cursor-pointer px-6 py-4 rounded-full text-dark bg-ctaDark">
				Soy profesional
			</div>
		</div>

		<div class="flex w-full space-x-8">
			<div class="w-2/3 flex flex-col">

			  <div class="group-row">
			    <div class="group-col">
			    	<label for="tipo_documento">Tipo de documento:</label>
				    <select id="tipo_documento" name="tipo_documento" required>
				      <option value="" selected>Selecciona ...</option>
				      <option value="documentoUnico">Documento único</option>
				      <option value="pasaporte">Pasaporte</option>
				    </select>
			    </div>
			    <div class="group-col">
				    <label for="num_documento">Numero Documento:</label>
				    <input type="text" id="num_documento" name="num_documento" required>  	
			    </div>
			  </div>

			  <div class="group-row">
			    <div class="group-col">
				    <label for="nombre">Nombre:</label>
				    <input type="text" id="nombre" name="nombre" required>
			    </div>
			    <div class="group-col">
				    <label for="apellido">Apellido:</label>
				    <input type="text" id="apellido" name="apellido" required>	
			    </div>
			  </div>

			  <div class="w-full flex space-x-8 mb-4">
			    <div class="group-col w-1/3">
			  		<label for="calle">Calle:</label>
			    	<input type="text" id="calle" name="calle" required>
			    </div>
			    <div class="group-col w-1/3">
				    <label for="altura">Altura:</label>
				    <input type="text" id="altura" name="altura" required>
			    </div>
			    <div class="group-col w-1/3">
			   		<label for="piso">Piso:</label>
			    	<input type="text" id="piso" name="piso">
			    </div>
			  </div>

			  <div class="w-full flex space-x-8 mb-4">
			    <div class="group-col w-1/3">
				    <label for="depto">Depto.:</label>
				    <input type="text" id="depto" name="depto">
			    </div>
			    <div class="group-col w-1/3">
				    <label for="barrio">Barrio:</label>
				    <input type="text" id="barrio" name="barrio" required>
			    </div>
			    <div class="group-col w-1/3">
				    <label for="localidad">Localidad:</label>
				    <input type="text" id="localidad" name="localidad" required>
			    </div>
			  </div>


			  <div class="group-row">
			    <div class="group-col">
				    <label for="telefono">Teléfono:</label>
				    <input type="tel" id="telefono" name="telefono" required>
			    </div>
			    <div class="group-col">
				    <label for="email">E-mail:</label>
				    <input type="email" id="email" name="email" required>	
			    </div>
			  </div>

			  <div class="group-row">
			    <div class="group-col">
				    <label for="contrasenia">Contraseña:</label>
				    <input type="password" id="contrasenia" name="contrasenia" required>
			    </div>
			    <div class="group-col">
				    <label for="repetirContrasenia">Repetir Contraseña:</label>
				    <input type="password" id="repetirContrasenia" name="repetirContrasenia" required>
			    </div>
			  </div>

			</div>


			<div class="w-1/3 ">
				<?php showAlert(); ?>
				<img class="h-44 object-cover" src="<?php echo URLROOT; ?>/img/logo.png" alt="">

				<div id="profesional" class="hidden flex flex-col space-y-4">
					<div class="group-col">
				    <label for="nombre_comercial">Nombre Comercial:</label>
				    <input type="text" id="nombre_comercial" name="nombre_comercial" >
					</div>

					<div class="flex flex-col space-y-4">
				    <p>Profesion:</p>

						<div class="w-full px-10">
							<?php if(isset($data['profesiones'])) : ?>
								<?php foreach ($data['profesiones'] as $row) : ?>
							<div class="flex justify-between">
						    <label for="profesion"><?php echo $row->profesion ?></label>
						    <input type="checkbox" name="profesion" value="<?php echo $row->id ?>">
						  </div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="group-col">
				    <label for="modalidad">Modalidad de Trabajo:</label>
				    <select id="modalidad" name="modalidad">
				      <option value="domicilio">Domicilio</option>
				      <option value="salon">En Salón</option>
				    </select>
				  </div>

					<div class="group-col">
				    <label for="zona">Zona de Trabajo:</label>
				    <select id="zona" name="zona">
				      <option value="zona1">Zona 1</option>
				      <option value="zona2">Zona 2</option>
				      <option value="zona3">Zona 3</option>
				    </select>
				  </div>
			  </div>
			   
			</div>

		</div>


		<div class="w-full flex items-center justify-center">
			<button name="registrar_profesional" type="submit" class="p-4 w-1/2 rounded-full bg-neutral text-white">Registrarme</button>
		</div>
  </form>



    </div>
  </section>

<script>
	const profesional = document.querySelector('#profesional')
	const btnPro = document.querySelector('#btn-pro')
	btnPro.addEventListener('click', () => {
		profesional.classList.toggle('hidden')
		profesional.previousElementSibling.classList.toggle('hidden')
	})
</script>

<?php require APPROOT . '/views/pages/partials/footer.php'; ?>