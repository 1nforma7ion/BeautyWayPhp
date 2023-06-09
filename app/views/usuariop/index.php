<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">
		<?php if(isset($_SESSION['user_email'])) : ?>

		<nav class="hidden md:flex flex-col w-1/4  text-white rounded-xl p-4 text-white text-xl">

			<li class="list-none  hover:border-white">
				<a class="py-3 px-6 flex justify-between items-center hover:rounded-full hover:bg-neutral <?= ($data['page'] == 'galeria') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/galeria/' ?>"> 
					 <span>Inicio</span><i class="fa-solid fa-home  "></i>
				</a>
			</li>

			<li class="list-none   hover:border-white">
				<a class="py-3 px-6 flex justify-between items-center hover:rounded-full hover:bg-neutral <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/about' ?>"> 
					<span>Perfil</span><i class="fa-solid fa-book "></i> 
				</a>
			</li>

			<li class="list-none  hover:border-white">
				<a class="py-3 px-6 flex justify-between items-center hover:rounded-full hover:bg-neutral <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>">
					 <span>Mensajes</span><i class="fa-solid fa-envelope "></i>
				</a>
			</li>

			<li class="list-none  hover:border-white">
				<a class="py-3 px-6 flex justify-between items-center hover:rounded-full hover:bg-neutral <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>">
					 <span>Reservas</span><i class="fa-solid fa-envelope "></i>
				</a>
			</li>

			<li class="list-none  hover:border-white ">
				<a class="py-3 px-6 flex justify-between items-center rounded-full hover:bg-cta bg-ctaDark text-dark text-2xl <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>">
					 <span>Nuevo Publicar</span><i class="fas fa-edit "></i>
				</a>
			</li>

		</nav>
		<?php 	else : ?>
		<div class="hidden md:block w-1/4  p-4 ">	
			<nav class="p-4 flex flex-col space-y-4 h-full rounded-xl bg-white text-dark text-xl">

				<h2 class="text-4xl font-bold">	Ofertas</h2>

				<div class=" w-full ">
					<img src="<?php echo URLROOT; ?>/img/doctor.jpg" alt="imagen logo" class=" w-full">
					
				</div>

				<div class="w-full ">
					<img src="<?php echo URLROOT; ?>/img/doctor.jpg" alt="imagen logo" class=" w-full">
					
				</div>



			</nav>
		</div>

		<?php endif; ?>


		<div class="flex w-full md:w-3/4 overflow-hidden">
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
							<div class="flex items-center">
								<img src="<?php echo URLROOT; ?>/img/logo.png" alt="imagen logo" class="h-16 w-16 rounded-full">
							</div>
							<div class="flex flex-col space-y-4">
								<h1 ><a href="" class="text-dark hover:text-fbk text-2xl  font-bold">Masajes & Spa</a></h1>
								<span>05-Junio-2023 | 04:00 PM</span>
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




			</div>


		</div>

	</div>
</div>




<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>