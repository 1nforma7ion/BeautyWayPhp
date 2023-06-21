<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full md:w-3/4 bg-neutral overflow-hidden font-dmsans">
			<div class="flex flex-col w-full  md:p-4  space-y-4  overflow-y-scroll no-scrollbar">

				<div class=" flex flex-col-reverse md:flex-row bg-white text-darkborder drop-shadow-lg hover:drop-shadow-card ">

					<div class="img_post relative flex w-full md:w-2/3 items-center">
						<img src="<?php echo URLROOT; ?>/img/pies.jpg" alt="imagen logo" class="w-full h-72 md:h-96 object-cover">
						<span class="date_post absolute w-max h-max bottom-4 right-0 md:top-4 md:left-0 rounded-r-lg text-sm text-dark p-4 bg-ctaDark md:text-2xl font-bold"> Zona Norte  </span>

						<div class="date_post absolute w-full flex justify-around h-max bottom-4 right-0 md:bottom-4  md:text-2xl font-bold">
							<button class="w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <i class="fas fa-heart "></i> Me gusta  </button>
							<button class="w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <i class="fas fa-comment "></i> Comentarios  </button>
							<button class="w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <i class="fas fa-share "></i> Compartir  </button>

						</div>
					</div>
										
					<div class="relative md:h-96 w-full flex flex-col p-4 md:w-1/3 space-y-4 ">
						<div class="flex space-x-4">

							<div class="flex flex-col space-y-4">
								<div class="w-full flex items-center space-x-4">
									<img src="<?php echo URLROOT; ?>/img/logo.png" alt="imagen logo" class="h-16 w-16 rounded-full">
									<h1 ><a href="" class="text-dark hover:text-fbk text-xl  font-bold">Masajes & Spa Cosmetics Pedicure</a></h1>
								</div>
								
								<div class="flex w-full justify-center bg-primary rounded-xl p-1">
									<i class="fas fa-calendar-alt mr-2"></i>
									<span class="text-sm"> 05-Junio-2023</span>	
								</div>
							</div>
						</div>
			      <span class=" text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Volup Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus reprehenderit reiciendis ipsum qui odio assumenda numquam ad? Odit quos eligendi, quam autem illum possimus molestias maxime iste magni eveniet deleniti!</span>
	  				
	  				<div class="absolute flex bottom-4 self-center text-sm text-fbk">
							<a href="" class=" rounded-full text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
			      		Ver detalles<i class="fas fa-arrow-right ml-4 "></i>
			      	</a>
						</div>

					</div>

				</div>


				<div class=" flex flex-col-reverse md:flex-row bg-white text-darkborder drop-shadow-lg hover:drop-shadow-card ">
					<div class="md:h-96 w-full flex flex-col py-4 px-6 md:w-1/2 space-y-4 ">
						<h1 ><a href="" class="text-dark hover:text-fbk text-2xl md:text-4xl font-bold">titulo</a></h1>
			      <div class="text-sm text-fbk">
							<i class="fas fa-arrow-right ml-4 "></i>
						</div>
			      <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum illo nobis, consequuntur minus eveniet laboriosam porro reiciendis tempore odio ullam hic corrupti suscipit eligendi dolorum, commodi, inventore sed amet aliquid?</span>
	  				
			      <div class="flex cursor-pointer self-center mt-auto md:mt-16">
			      	<a href="" class=" text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
			      		Read More<i class="fas fa-arrow-right ml-4 "></i>
			      	</a>
			      </div>

					</div>
					<div class="img_post ">
						<img src="<?php echo URLROOT; ?>/img/doctor.jpg" alt="imagen logo" class="w-full">
						<span class="date_post">Nilton | 05-05-2023 </span>
					</div>
				</div>

				<div class=" flex flex-col-reverse md:flex-row bg-white text-darkborder drop-shadow-lg hover:drop-shadow-card ">
					<div class="md:h-96 w-full flex flex-col py-4 px-6 md:w-1/2 space-y-4 ">
						<h1 ><a href="" class="text-dark hover:text-fbk text-2xl md:text-4xl font-bold">titulo</a></h1>
			      <div class="text-sm text-fbk">
							<i class="fas fa-arrow-right ml-4 "></i>
						</div>
			      <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum illo nobis, consequuntur minus eveniet laboriosam porro reiciendis tempore odio ullam hic corrupti suscipit eligendi dolorum, commodi, inventore sed amet aliquid?</span>
	  				
			      <div class="flex cursor-pointer self-center mt-auto md:mt-16">
			      	<a href="" class=" text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
			      		Read More<i class="fas fa-arrow-right ml-4 "></i>
			      	</a>
			      </div>

					</div>
					<div class="img_post ">
						<img src="<?php echo URLROOT; ?>/img/doctor.jpg" alt="imagen logo" class="w-full">
						<span class="date_post">Nilton | 05-05-2023 </span>
					</div>
				</div>


			</div>


		</div>

	</div>
</div>




<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>