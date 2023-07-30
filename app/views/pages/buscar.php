<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full md:h-screen flex flex-col md:flex-row md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class=" w-full md:w-1/4 py-4">

			<div class="p-4 flex flex-col space-y-8 h-full rounded-lg bg-white font-dmsans">
				<h2 class="text-center text-2xl font-bold">	Destacados</h2>	
				<?php foreach($data['descuentos'] as $row) : ?>
					<?php if($row->descuento > 10) : ?>

					<div class="relative flex  w-full rounded-lg">
						<img src="<?php echo URLROOT . $row->imagen ?>" alt="imagen logo" class="w-full h-48 object-cover rounded-lg">
						<span class="date_post absolute w-max h-max bottom-4 left-0 rounded-r-lg  text-white p-2 bg-neutral "> 
						<?php echo $row->servicio ?>  </span>

						<?php 
							$desc = explode('.', $row->descuento);
							$desc = $desc[0];
						?>
						<button class="absolute top-0 right-0 h-12 w-12 rounded-full text-dark bg-neutral text-center text-white">
							<span class="text-xl"><?php echo $desc . ' '?></span>% 
						</button>

					</div>

					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full md:w-3/4 overflow-hidden font-dmsans">
			<div class="flex flex-col w-full  py-4 md:p-4  space-y-8  overflow-y-scroll no-scrollbar">

				<div class="w-full flex space-x-8 p-4 bg-white rounded-xl text-xl text-neutral text-center">
					<h2 class="text-2xl">Resultados para : <?php echo $data['termino'] ?> </h2>  
					<h2 class="text-2xl">__ Total resultados : <?php echo count($data['resultados']) ?> </h2>  
				</div>
				<!-- publicaciones -->
				<?php foreach($data['resultados'] as $row) : ?>
					<div class=" flex flex-col-reverse md:flex-row bg-white text-dark drop-shadow-lg hover:drop-shadow-card rounded-lg">

					<div class="img_post relative flex w-full md:w-2/3 items-center ">
						<img src="<?php echo URLROOT . $row->imagen ?>" alt="imagen logo" class="w-full h-72 md:h-96 object-cover rounded-b-lg md:rounded-br-none md:rounded-l-lg">
						<span class="date_post absolute w-max h-max top-4 left-0 rounded-r-lg text-sm text-dark p-2 bg-ctaDark md:text-xl font-bold"> 
						<?php echo $row->servicio ?>  </span>

						<div class="date_post absolute w-full flex justify-around h-max bottom-4 right-0 md:bottom-4  md:text-2xl font-bold">
							<button class="btn_alert w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <?php echo $row->me_gusta ?>   <i class="fas fa-heart "></i> Me gusta  </button>
							<button class="btn_alert w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <?php echo $row->comentarios ?>   <i class="fas fa-comment "></i> Comentarios  </button>
						</div>

						<span class="hidden absolute w-max h-max top-4 right-4 rounded-xl text-xl p-4 bg-cta"> 
							<a class="px-3 py-2 text-2xl " href="<?php echo URLROOT . '/pages/login' ?>">
								<span class="ml-2 underline">Iniciar Sesión</span> 
							</a>
						</span>

					</div>
										
					<div class="relative md:h-96 w-full flex flex-col items-center p-4 md:w-1/3 space-y-4 ">
						<div class="flex space-x-4">

							<div class="flex flex-col justify-center items-center space-y-4">

								<div class="w-full flex items-center space-x-4">
									<?php if (!empty($row->imagen_comercial)) : ?>
										<img src="<?php echo URLROOT . $row->imagen_comercial ?>" class="h-16 w-16 rounded-full object-cover ">
									<?php else: ?>
										<img src="<?php echo URLROOT . '/img/user.png' ?>" alt="imagen usuario" class="h-16 w-16 rounded-full object-cover ">
									<?php endif; ?>

									<h1 ><a href="" class="text-dark hover:text-fbk text-xl  font-bold"> <?php echo $row->nombre_comercial ?></a></h1>
								</div>

								<div class="flex w-full justify-between items-center ">
									<div class="flex space-x-2 px-2 py-1 rounded-xl bg-neutral text-white ">
										
										<?php 
											$desc = explode('.', $row->descuento);
											$desc = $desc[0];
										?>
										<span class="text-lg"> Desc. <?php echo $desc . ' %' ?> </span>
									</div>
									<div class="flex items-center space-x-2 px-2 py-1 rounded-xl bg-primary ">
										<i class="fas fa-calendar-alt mr-2"></i>
										<span class="text-lg"> <?php echo fixedFecha($row->creado) ?> </span>	
									</div>
								</div>

								<div class="flex w-full justify-center items-center bg-ctaDark text-dark rounded-xl p-1 text-xl">
									<i class="fas fa-map-marker-alt mr-2"></i>
									<span> <?php echo $row->zona_public ?> </span>	
								</div>

							</div>
						</div>
			      <span class=" text-sm"> <?php echo $row->descripcion ?>  </span>
	  				

					</div>

				</div>
				<?php endforeach; ?>




			</div>


		</div>

	</div>
</div>


<?php 
	// echo "<pre>";
	// print_r($data);

 ?>


<script>
	const allBtnAlert = document.querySelectorAll('.btn_alert')
  allBtnAlert.forEach( btn => {
    btn.addEventListener('click', (e) => {
    	const loginAlert = e.currentTarget.parentElement.nextElementSibling
    	if(loginAlert.classList.contains('hidden')) {
    		loginAlert.classList.toggle('hidden')

	    	setTimeout(() => {
	      	loginAlert.classList.toggle('hidden')
	    	},6000)
    	}

    })
  })
</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>