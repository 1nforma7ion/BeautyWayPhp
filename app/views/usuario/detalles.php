<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full md:h-screen flex flex-col md:flex-row md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">


		<!-- columna derecha -->
		<div class="flex w-full overflow-hidden font-dmsans">
			<div class="flex flex-col w-full py-4  space-y-8  overflow-y-scroll no-scrollbar">

				<!-- publicaciones -->
				<div class=" flex flex-col-reverse md:flex-row bg-white text-dark drop-shadow-lg hover:drop-shadow-card rounded-lg">

					<div class="img_post relative flex w-full md:w-2/3 items-center">
						<img src="<?php echo URLROOT . $data['publicacion']->imagen ?>" alt="imagen logo" class="w-full h-72 h-[700px] object-cover rounded-b-lg md:rounded-br-none md:rounded-l-lg">
						<span class="date_post absolute w-max h-max top-4 left-0 rounded-r-lg text-sm text-dark p-2 bg-ctaDark md:text-xl font-bold"> 
						<?php echo $data['publicacion']->servicio ?>  </span>

						<div class="date_post absolute w-full flex justify-around h-max bottom-4 right-0 md:bottom-4  md:text-2xl font-bold">
							<button class="btn_alert w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <?php echo $data['publicacion']->me_gusta ?>   <i class="fas fa-heart "></i> Me gusta  </button>
							<button class="btn_alert w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <?php echo $data['publicacion']->comentarios ?>   <i class="fas fa-comment "></i> Comentarios  </button>
						</div>

					</div>
										
					<div class="relative h-[700px] w-full flex flex-col items-center p-4 md:w-1/3 space-y-4 ">
						
						<div class="flex flex-col px-4 py-2">
						  <h1 class=" text-2xl text-neutral font-bold"> CONFIRMÁ TU RESERVA EN </p>
						</div>

						<div class="flex space-x-4">

							<div class="flex flex-col justify-center items-center space-y-4">

								<div class="w-full flex items-center space-x-4">
									<?php if (!empty($data['publicacion']->imagen_comercial)) : ?>
										<img src="<?php echo URLROOT . $data['publicacion']->imagen_comercial ?>" class="h-12 w-12 rounded-full object-cover ">
									<?php else: ?>
										<img src="<?php echo URLROOT . '/img/user.png' ?>" alt="imagen usuario" class="h-12 w-12 rounded-full object-cover ">
									<?php endif; ?>

									<h1 ><a href="" class="text-dark hover:text-fbk text-xl  font-bold"> <?php echo $data['publicacion']->nombre_comercial ?></a></h1>
								</div>
								
							</div>
						</div>

  					<div class="w-3/4 mx-auto flex flex-col">
					    <h2 class="text-xl py-1">Dirección: </h2>
					    <h2 class="text-neutral"><?php echo $data['publicacion']->calle . ' #' . $data['publicacion']->altura . ' - ' . $data['publicacion']->barrio ?> </h2>
					  </div>

			      <!-- form RESERVAR -->
	  				<form action="" method="post" autocomplete="off">
	  					<input type="hidden" id="id_profesional" value="<?php echo $data['publicacion']->id_profesional ?>">
	  					<input type="hidden" id="url" data-root="<?php echo URLROOT ?>" data-controller="<?php echo $data['controller'] ?>">
	  					
	  					<div class="w-3/4 mx-auto flex flex-col">
						    <h2 class="text-xl py-1">Servicio: </h2>
						    <h2 class="text-2xl text-neutral py-1 font-bold"><?php echo strtoupper($data['publicacion']->servicio) ?> </h2>
	  						<input type="hidden" name="servicio" id="servicio" value="<?php echo $data['publicacion']->servicio ?>">
						  </div>

							<div class="w-3/4 py-1 mx-auto flex flex-col">
						    <label for="dia" class="text-xl py-1">Fecha:</label>
						    <select id="dia" name="dia" class="p-1 border-neutral border rounded-xl outline-none" required>
						 			<option value="">Selecciona el dia</option>
						     	<?php if(isset($data['dias'])) : ?>
										<?php foreach ($data['dias'] as $row) : ?>
											<option value="<?php echo $row->dia ?>"><?php echo $row->dia ?></option>
										<?php endforeach; ?>
									<?php endif; ?> 
						    </select>
						  </div>

							<div class="w-3/4 py-1 mx-auto flex flex-col">
						    <label for="turno" class="text-xl py-1">Turnos Disponibles:</label>
						    <select id="turno" name="turno" class="p-1 border-neutral border rounded-xl outline-none" required>
						 			<option value="">Selecciona el turno</option>

						    </select>
						  </div>

						  <div class="flex flex-col p-4">
						    <p class=" text-red text-sm"> * Al crear tu reserva aceptas los <span class="text-neutral">Terminos y Condiciones.</span> </p>
						    <p class=" text-red text-sm"> ** Puedes cancelar tu reserva hasta 24 hrs antes de su inicio. </p>
						  </div>

		  				<div class="py-4 flex flex-col space-y-4 items-center w-full ">
				      	<button type="submit" name="crear_reserva" class=" rounded-full text-white text-2xl px-4 py-3 w-3/4 bg-neutralDark "> <i class="fas fa-book mr-2"></i> Reservar  </button>
				      	<a href="<?php echo URLROOT . '/' . $data['controller'] . '/index' ?>" class="btn_reservar rounded-full text-white text-xl px-4 py-2 w-3/4 bg-red text-center "> <i class="fas fa-xmark mr-2"></i> Cancelar  </a>
							</div>
						</form>

					</div>

				</div>
				



			</div>
		</div>

	</div>
</div>


<?php 

echo "<pre>";
// print_r($data);
// print_r($data['imagenes_perfil']);
echo "</pre>";

 ?>

<script>
	const id_profesional = document.querySelector('#id_profesional')
	let turnoSelect = document.querySelector('#turno')

	const url = document.querySelector('#url')
	const root = url.getAttribute('data-root')
	const controller = url.getAttribute('data-controller')

	const dia = document.querySelector('#dia')
	dia.addEventListener('change', (e) => {
		let fecha = e.target.value
		
		const xhr = new XMLHttpRequest()
			xhr.open('GET', `${root}/${controller}/turnos/${id_profesional.value}/${fecha}`, true)
			xhr.onload = function () {
				if(this.status == 200) {
					let turnos = JSON.parse(this.responseText)
					let output = ''

					for (let turno in turnos) {
						output += `<option value="${turnos[turno].hora_inicio}-${turnos[turno].hora_fin}"> Turno ${turnos[turno].hora_inicio} hrs </option> \n`
						turnoSelect.innerHTML = output
					}
						// console.log(output)
				}
			}
			xhr.send()
	})




</script>

<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>