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
							<button class="btn_like w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> 
								<span><?php echo $data['publicacion']->me_gusta ?> </span>
								<i class="fas fa-heart <?php echo in_array($data['publicacion']->id_public, $data['allLikes']) ? 'text-red' : '' ?>"></i>
								<span>Me gusta</span>
								<input type="hidden" value="<?php echo $data['publicacion']->id_public ?>">
							</button>
							<a href="#comentarios" class=" w-44 rounded-full text-sm text-dark p-2 bg-ctaDark text-center "> 
								<?php echo $data['publicacion']->comentarios ?>   
								<i class="fas fa-comment "></i> Comentarios  
							</a>

						</div>


					</div>
										
					<div class="relative h-[700px] w-full flex flex-col items-center p-4 md:w-1/3 space-y-4 ">
						

						<div class="flex space-x-4">

							<div class="flex flex-col justify-center items-center space-y-4">
								<h2 class=" text-2xl bg-white text-neutral font-bold"> 		CONFIRMÁ TU RESERVA EN		</h2>

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



			      <!-- form RESERVAR -->
	  				<form action="" method="post" autocomplete="off">
	  					<input type="hidden" id="id_profesional" value="<?php echo $data['publicacion']->id_profesional ?>">
	  					<input type="hidden" name="nombre_comercial" value="<?php echo $data['publicacion']->nombre_comercial ?>">
	  					<input type="hidden" name="email_prof" value="<?php echo $data['publicacion']->email ?>">
	  					<input type="hidden" id="url" data-root="<?php echo URLROOT ?>" data-controller="<?php echo $data['controller'] ?>">
		  				

	  				<div class="px-6 mx-auto flex flex-col">

	  					<?php if ($data['publicacion']->modalidad == "Domicilio"): ?>
		  					<div class="flex justify-between text-dark py-1 "> 
		  						<span class="px-4 py-2 bg-ctaDark rounded-xl "><i class="fas fa-shipping-fast mr-2"></i><?php echo 'Atiende a ' . $data['publicacion']->modalidad ?> </span>
		  						<span class="px-4 py-2 bg-ctaDark rounded-xl "><i class="fas fa-map-marker-alt mr-2"></i><?php echo $data['publicacion']->zona ?> </span>
		  					</div>
		  					<h2 class="text-lg py-1">Tu dirección : </h2>
					    	<h2 class="py-1 text-xl text-neutral font-bold"><?php echo $_SESSION['user_calle'] . ' #' . $_SESSION['user_altura'] . ' - ' . $_SESSION['user_barrio'] ?> </h2>
	  						<input type="hidden" name="modalidad" value="<?php echo $data['publicacion']->modalidad ?>">
	  						
	  						<input type="hidden" name="direccion" value="<?php echo $_SESSION['user_calle'] . ' #' . $_SESSION['user_altura'] . ' - ' . $_SESSION['user_barrio'] ?>">

	  					<?php else : ?>
								<div class="flex justify-between text-dark py-1 "> 
		  						<span class="px-4 py-2 bg-ctaDark rounded-xl "><i class="fas fa-store-alt mr-2"></i><?php echo 'Atiende ' . $data['publicacion']->modalidad ?> </span>
		  						<span class="px-4 py-2 bg-ctaDark rounded-xl "><i class="fas fa-map-marker-alt mr-2"></i><?php echo $data['publicacion']->zona ?> </span>

		  					</div>
		  					<h2 class="text-lg py-1">Dirección del Salón: </h2>
					    	<h2 class="py-1 text-xl text-neutral font-bold"><?php echo $data['publicacion']->calle . ' #' . $data['publicacion']->altura . ' - ' . $data['publicacion']->barrio ?> </h2>
					    	<input type="hidden" name="modalidad" value="<?php echo $data['publicacion']->modalidad ?>">
	  						
	  						<input type="hidden" name="direccion" value="<?php echo $data['publicacion']->calle . ' #' . $data['publicacion']->altura . ' - ' . $data['publicacion']->barrio ?>">
	  					<?php endif; ?>
						   
					    
					  </div>

	  					<div class="px-6 mx-auto flex flex-col">
						    <h2 class="text-lg py-1">Servicio: </h2>
						    <h2 class="text-2xl text-neutral py-1 font-bold"><?php echo ucwords($data['publicacion']->servicio) ?> </h2>
	  						<input type="hidden" name="servicio" id="servicio" value="<?php echo $data['publicacion']->servicio ?>">
						  </div>

							<div class="px-6 py-1 mx-auto flex flex-col">
						    <label for="dia" class="text-lg py-1">Fecha:</label>
						    <select id="dia" name="dia" class="p-1 border-neutral border rounded-xl outline-none" required>
						 			<option value="">Selecciona el dia</option>
						     	<?php if(isset($data['dias'])) : ?>
										<?php foreach ($data['dias'] as $row) : ?>
											
											<?php if (in_array($data['publicacion']->id_public, $data['reservas_id']) && in_array($row->dia, $data['reservas_dias'])) : ?>

											<?php else: ?>
												<option value="<?php echo $row->dia ?>"><?php echo $row->dia ?>  </option>

											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?> 
						    </select>
						  </div>

							<div class="px-6 py-1 mx-auto flex flex-col">
						    <label for="turno" class="text-lg py-1">Turnos Disponibles:</label>
						    <select id="turno" name="turno" class="p-1 border-neutral border rounded-xl outline-none" required>
						 			<option value="">Selecciona el turno</option>

						    </select>
						  </div>

						  <div class="flex flex-col p-4">
						    <p class=" text-red text-sm"> * Al crear tu reserva aceptas los <span class="text-neutral">Terminos y Condiciones.</span> </p>
						    <p class=" text-red text-sm"> ** Puedes cancelar tu reserva hasta 24 hrs antes de su inicio. </p>
						  </div>

		  				<div class="py-2 flex flex-col space-y-4 items-center w-full ">
		  					<button class="hidden rounded-full text-dark bg-cta text-2xl px-4 py-3 w-3/4  "> <i class="fas fa-clock mr-2"></i> Creando Reserva ... </button>
				      	<button id="btn_crear_reserva" type="submit" name="crear_reserva" class=" rounded-full text-white text-2xl px-4 py-3 w-3/4 bg-neutralDark "> <i class="fas fa-book mr-2"></i> Reservar  </button>
				      	<a href="<?php echo URLROOT . '/' . $data['controller'] . '/index' ?>" class="btn_reservar rounded-full text-white text-xl px-4 py-2 w-3/4 bg-red text-center "> <i class="fas fa-xmark mr-2"></i> Cancelar  </a>
							</div>
						</form>

					</div>

				</div>

				<div id="comentarios" class="flex w-full  md:w-2/3 bg-white rounded-xl  font-dmsans ">

					<div class="flex flex-col w-full  md:p-4  space-y-4">

						<div class="flex flex-col px-4 py-2">
						  <h1 class=" text-2xl text-neutral font-bold"> Comentarios ( <?php echo $data['publicacion']->comentarios; ?> ) </h1>
						</div>

						<div class="flex flex-col px-4 py-2 space-y-4">
							<?php foreach($data['comentarios'] as $row) : ?>
								<div class="flex flex-col rounded-xl space-y-4 p-4 bg-primary">
									<div class="flex space-x-8 items-center ">
										<?php if ($row->rol_usuario == 3) : ?>
											<h3 class="text-2xl text-dark font-bold"> <?php echo $row->nombre_comercial ?> </h3>	
										<?php else: ?>
											<h3 class="text-2xl text-dark font-bold"> <?php echo $row->nombre . ' ' . $row->apellido ?> </h3>	
										<?php endif; ?>

										<span class="text-sm text-neutral "> <?php echo fixedFecha($row->fecha) ?> </span>
									</div>
									<p class="px-6"> <?php echo $row->comentario ?> </p>
								</div>
							<?php endforeach; ?>
						</div>

						<div class="flex flex-col px-4 py-2">
							
							<form action="" autocomplete="off" method="POST" enctype="multipart/form-data">

						  		<h1 class="p-4 text-2xl text-neutral font-bold"> Escribir un Comentario : </h1>

									<div class=" w-full flex flex-col p-4 md:w-2/3 space-y-4 ">
										
							      <div class="w-full">
							      	<textarea name="comentario" id="comentario" rows="6"  class="w-full px-2 resize-none outline-none focus:border-neutral border-2 border-primary " placeholder="Escribe tu comentario " required></textarea>
							      </div>
					  				
					  				<div class="flex flex-col self-center text-sm text-fbk">
											<button name="create_comentario" type="submit" class=" rounded-full text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
							      		Comentar 
							      	</button>
										</div>

									</div>

							</form>

						</div>

					</div>
				 
				
					
				</div>
				



			</div>
		</div>

	</div>
</div>


<?php 

echo "<pre>";
// print_r($data);
echo "</pre>";

 ?>

<script>

	let btnCrearReserva = document.querySelector('#btn_crear_reserva')
	btnCrearReserva.addEventListener('click', e => {
		let btn_alerta = e.target.previousElementSibling
		btn_alerta.classList.remove('hidden')
		e.target.classList.add('hidden')
	})

	let url = document.querySelector('#url')
	let root = url.getAttribute('data-root')
	let controller = url.getAttribute('data-controller')
	let endpoint = `${root}/${controller}`
	// console.log(endpoint)


	const allBtnLike = document.querySelectorAll('.btn_like')
	allBtnLike.forEach(btn => {
		btn.addEventListener('click', e => {
			

			let id_public = e.currentTarget.lastElementChild.value
			let likes_public = e.currentTarget.firstElementChild
			let icon_public = e.currentTarget.querySelector('i')
			// console.log(icon_public)

      let item = JSON.stringify({ id_publicacion: id_public })

			fetch(`${root}/usuario/like`, {
		    method: 'post',
		    body: item,
		    headers: {
		      'Accept': 'application/json',
		      'Content-Type': 'application/json'
		    }
			})
			.then( res => res.json() )
			.then( data => {
				likes_public.innerHTML = data.likes
				icon_public.classList.toggle(data.icon_color)
				// console.log(data)
			})
			.catch(console.error);
		})

	})



	const id_profesional = document.querySelector('#id_profesional')
	let turnoSelect = document.querySelector('#turno')

	const dia = document.querySelector('#dia')
	dia.addEventListener('change', (e) => {
		let fecha = e.target.value
		// console.log(fecha + root + id_profesional.value)

		const xhr = new XMLHttpRequest()
			xhr.open('GET', `${endpoint}/turnos/${id_profesional.value}/${fecha}`, true)
			xhr.onload = function () {
				if(this.status == 200) {
					let turnos = JSON.parse(this.responseText)
					// console.log(turnos)
					let output = ''

					for (let turno in turnos) {
						output += `<option value="${turnos[turno].hora_inicio}-${turnos[turno].hora_fin}"> Turno ${turnos[turno].hora_inicio} hrs </option> \n`
						turnoSelect.innerHTML = output
					}
						// console.log(output)
				} else {
					'ocurrio un error'
				}
			}
			xhr.send()
	})




</script>

<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>