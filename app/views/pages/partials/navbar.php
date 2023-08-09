<nav class="flex py-2 items-center md:py-0 md:justify-between md:px-6.5 md:bg-neutral bg-neutralDark text-lg text-dark font-dmsans tracking-wider">

	<div class="hidden md:flex w-max items-center bg-white">
		<a href="<?php echo URLROOT . '/' . $data['controller'] . '/index'?>"><img src="<?php echo URLROOT; ?>/img/logo.png" alt="imagen logo" class="h-16"></a>
	</div>

	<div class=" flex w-full md:w-3/4 items-center space-x-8 justify-around md:justify-end text-xl">

		<div class=" hidden md:flex w-1/2 h-12 rounded p-1 ">
			<form action="<?php echo URLROOT; ?>/pages/buscar" method="post" autocomplete="off" class=" md:flex w-full " >
				<input name="term" type="text" class="w-full px-6 py-2 outline-none  rounded-l-xl " placeholder="Buscar zona, servicio o profesional">
			  <button name="btn_buscar" type="submit" class="w-max px-4 py-2 bg-primaryDark text-gray font-bold rounded-r-xl text-xl hover:bg-ctaLight"><i class="fas fa-search "></i></button>
			</form>
		</div>
		
<?php if(!isset($_SESSION['user_email'])) : ?>

		<li class="list-none">
			<a class="px-3 py-2 flex items-center hover:text-dark hover:bg-cta rounded text-white " href="<?php echo URLROOT . '/pages/login' ?>">
				<i class="fas fa-user"></i><span class="ml-2 md:text-xl text-sm">Iniciar Sesión</span> 
			</a>
		</li>

		<li class="list-none">
			<a class="px-3 py-2 flex items-center hover:text-dark hover:bg-cta rounded text-white " href="<?php echo URLROOT . '/pages/registrar' ?>">
				<i class="fas fa-book"></i><span class="ml-2 md:text-xl text-sm">Registrarme</span> 
			</a>
		</li>
<?php endif; ?>


	</div>
</nav>
