
		<nav class="hidden md:flex flex-col w-1/4  text-white rounded-xl p-4 text-white text-xl">

			<li class="list-none  hover:border-white">
				<a class="py-3 px-6 flex justify-between items-center hover:rounded-full hover:bg-neutral <?= ($data['page'] == 'index') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/galeria/' ?>"> 
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
				<a class="py-3 px-6 flex justify-between items-center hover:rounded-full hover:bg-neutral <?= ($data['page'] == 'reservas') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/login' ?>">
					 <span>Reservas</span><i class="fa-solid fa-envelope "></i>
				</a>
			</li>

			<li class="list-none  hover:border-white ">
				<a class="py-3 px-6 flex justify-between items-center rounded-full hover:bg-cta bg-ctaDark text-dark text-2xl <?= ($data['page'] == 'about-us') ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . '/publicar' ?>">
					 <span>Nuevo Publicar</span><i class="fas fa-edit "></i>
				</a>
			</li>

		</nav>