<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">
		<?php if(!isset($_SESSION['user_email'])) : ?>

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