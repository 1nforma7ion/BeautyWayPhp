<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full md:w-3/4 overflow-hidden font-dmsans">
			<div class="flex flex-col w-full  md:p-4  space-y-4  overflow-y-scroll no-scrollbar">

				<!-- publicaciones -->
				<?php foreach($data['publicaciones'] as $row) : ?>
					<div class=" flex flex-col-reverse md:flex-row bg-white text-dark drop-shadow-lg hover:drop-shadow-card rounded-lg">

					<div class="img_post relative flex w-full md:w-2/3 items-center">
						<img src="<?php echo URLROOT . $row->imagen ?>" alt="imagen logo" class="w-full h-72 md:h-96 object-cover rounded-l-lg">
						<span class="date_post absolute w-max h-max bottom-4 right-0 md:top-4 md:left-0 rounded-r-lg text-sm text-dark p-2 bg-ctaDark md:text-xl font-bold"> 
						<?php echo $row->servicio ?>  </span>

						<div class="date_post absolute w-full flex justify-around h-max bottom-4 right-0 md:bottom-4  md:text-2xl font-bold">
							<button class="w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <i class="fas fa-heart "></i> Me gusta  </button>
							<button class="w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <i class="fas fa-comment "></i> Comentarios  </button>

						</div>
					</div>
										
					<div class="relative md:h-96 w-full flex flex-col p-4 md:w-1/3 space-y-4 ">
						<div class="flex space-x-4">

							<div class="flex flex-col justify-center items-center space-y-4">
								<div class="w-full flex items-center space-x-4">
									<?php if (!empty($data['imagenes_perfil'])) : ?>
										<img src="<?php echo URLROOT . $data['imagenes_perfil']->imagen_comercial ?>" class="h-16 w-16 rounded-full object-cover ">
									<?php else: ?>
										<img src="<?php echo URLROOT . '/img/user.png' ?>" alt="imagen usuario" class="h-16 w-16 rounded-full object-cover ">
									<?php endif; ?>

									<h1 ><a href="" class="text-dark hover:text-fbk text-xl  font-bold"> <?php echo $row->nombre_comercial ?></a></h1>
								</div>
								
								<div class="flex w-max justify-center items-center bg-primary rounded-xl p-1">
									<i class="fas fa-calendar-alt mr-2"></i>
									<span class="text-sm"> <?php echo fixedFecha($row->creado) ?> </span>	
								</div>
							</div>
						</div>
			      <span class=" text-sm"> <?php echo $row->descripcion ?>  </span>
	  				
	  				<div class="absolute flex bottom-4 self-center text-sm text-fbk">


							<a href="<?php echo URLROOT . '/' . $data['controller'] . '/reservar' ?>" class=" rounded-full text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
			      		Ver detalles<i class="fas fa-arrow-right ml-4 "></i>
			      	</a>
						</div>

					</div>

				</div>
				<?php endforeach; ?>

			</div>

		</div>

	</div>
</div>




<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>