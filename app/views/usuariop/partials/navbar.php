<nav class="flex py-2 md:py-0 md:justify-between md:px-6.5 md:bg-neutral bg-neutralDark text-lg text-white tracking-wider">
	<div class="hidden md:flex w-1/3 h-16 items-center">
		<a href="<?php echo URLROOT . '/' . $data['controller'] . '/index'?>"><img src="<?php echo URLROOT; ?>/img/logo.PNG" alt="imagen logo" class="h-12"></a>
	</div>


	<div class=" hidden md:flex w-1/3 h-12 rounded-full ">
		<input type="text" class="w-full px-6 py-2 outline-none  " placeholder="Escribir">
	  <button class="px-6 py-2 bg-white text-dark font-bold"><i class="fas fa-search text-neutral text-xl"></i></button>
	</div>


	<div class=" flex w-full md:w-1/3 items-center space-x-4 justify-center md:justify-end text-xl">
<?php if(!isset($_SESSION['user_email'])) : ?>

		<li class="list-none">
			<a class="p-3 flex items-center hover:border-b-2 hover:border-white <?= ($data['page'] == 'galeria') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>"> 
				<i class="fa-solid fa-home "></i> <span class="ml-2 hidden md:block text-md">Login</span>
			</a>
		</li>

		<li class="list-none ">
			<a class="p-3 flex items-center hover:border-b-2 hover:border-white <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/registrar' ?>"> 
				<i class="fa-solid fa-book"></i> <span class="ml-2 hidden md:block text-md">Register</span>
			</a>
		</li>
<?php endif; ?>

<?php if(isset($_SESSION['user_email'])) : ?>
		<li class="list-none">
			<a class="  flex items-center <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>">
				<img src="<?php echo URLROOT; ?>/img/anya1.JPG" alt="imagen logo" class="h-12 w-12 rounded-full"><span class="ml-2 hidden md:block text-md">Mi perfil</span>
			</a>
		</li>

		<li class="list-none">
			<a class="p-3 flex items-center hover:border-b-2 hover:border-white <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/pages/logout' ?>">
				<i class="fa-solid fa-sign-out-alt"></i><span class="ml-2 hidden md:block text-md">Cerrar Sesión</span> 
			</a>
		</li>

	<?php endif; ?>


	</div>
</nav>
