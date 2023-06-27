<nav class="flex py-2 items-center md:py-0 md:justify-between md:px-6.5 md:bg-neutral bg-neutralDark text-lg text-dark font-dmsans tracking-wider">

	<div class="hidden md:flex w-max px-4 h-16 items-center bg-white">
		<a href="<?php echo URLROOT . '/' . $data['controller'] . '/index'?>"><img src="<?php echo URLROOT; ?>/img/logo.png" alt="imagen logo" class="h-12"></a>
	</div>

	<div class=" flex w-full md:w-3/4 items-center space-x-8  md:justify-end text-xl">

		<div class=" hidden md:flex w-1/2 h-12 rounded p-1 ">
			<input type="text" class="w-full px-6 py-2 outline-none  rounded-l-xl " placeholder="Buscar publicación">
		  <button class="w-max px-4 py-2 bg-primaryDark text-gray font-bold rounded-r-xl text-xl hover:bg-ctaLight"><i class="fas fa-search "></i></button>
		</div>
		
<?php if(!isset($_SESSION['user_email'])) : ?>

		<li class="list-none">
			<a class="px-3 py-2 flex items-center hover:text-dark hover:bg-cta rounded text-white " href="<?php echo URLROOT . '/pages/login' ?>">
				<i class="fas fa-user"></i><span class="ml-2 hidden md:block text-md">Iniciar Sesión</span> 
			</a>
		</li>

		<li class="list-none">
			<a class="px-3 py-2 flex items-center hover:text-dark hover:bg-cta rounded text-white " href="<?php echo URLROOT . '/pages/registrar' ?>">
				<i class="fas fa-book"></i><span class="ml-2 hidden md:block text-md">Registrarme</span> 
			</a>
		</li>
<?php endif; ?>


	</div>
</nav>
