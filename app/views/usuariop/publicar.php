<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">
		<?php if(isset($_SESSION['user_email'])) : ?>

			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>

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

			<form action="<?php echo URLROOT . '/' . $data['controller']; ?>/publicar" autocomplete="off" method="POST" enctype="multipart/form-data">
				<div class=" flex flex-col-reverse md:flex-row bg-white text-darkborder drop-shadow-lg hover:drop-shadow-card ">

					<div class="img_post relative flex w-full md:w-2/3 items-center font-dmsans bg-primary">
						<canvas id="preview" class=" w-full h-72 md:h-96 "></canvas>

						<div class="date_post absolute w-1/4 h-max bottom-4 right-0 md:top-4 md:left-0 rounded-r-lg text-sm text-dark p-2 bg-ctaDark font-bold drop-shadow-card">
							<div><?php echo $_SESSION['user_zona'] ?></div>
						</div>

						<div class="absolute w-full flex justify-around items-center h-max bottom-6 left-0 ">
							<input id="img-input" type="file" name="imagen" hidden required>
							<label for="img-input" > 
		            <span class="p-4 font-bold rounded-r-xl bg-ctaDark text-dark drop-shadow-card">Subir Imagen  <i class="fas fa-image"></i> </span>
		          </label>	         

		          <div class="w-44 flex justify-between font-bold rounded-r-xl  bg-ctaDark text-dark drop-shadow-card">
		          	<label class="w-1/2">Descuento en % </label>
								<input type="text" name="descuento" id="descuento" class="px-6 w-1/2 outline-none focus:border-neutral border-2 border-primary " >
		          </div>

				      <div class="w-44 flex justify-between font-bold rounded-r-xl  bg-ctaDark text-dark drop-shadow-card">
		          	<label class="w-1/2">Vigencia (dias) </label>
								<input type="text" name="vigencia" id="vigencia" class=" px-6 w-1/2 outline-none focus:border-neutral border-2 border-primary " >
		          </div>

						</div>
					</div>
										
					<div class="relative md:h-96 w-full flex flex-col p-4 md:w-1/3 space-y-4 ">
						<div class="flex space-x-4">
							<div class="flex flex-col space-y-4">
								<div class="w-full flex items-center space-x-4">
									<img src="<?php echo URLROOT; ?>/img/logo.png" alt="imagen logo" class="h-16 w-16 rounded-full">
									<h1 ><a href="" class="text-dark hover:text-fbk text-xl  font-bold"><?php echo !is_null($_SESSION['user_nombre_comercial']) ? $_SESSION['user_nombre_comercial'] : '' ?></a></h1>
								</div>

							</div>

						</div>
			      <div class="w-full">
			      	<textarea name="descripcion" id="descripcion" rows="8"  class="w-full outline-none focus:border-neutral border-2 border-primary " placeholder="Escribe el contenido de la publicacion " required></textarea>
			      </div>
	  				
	  				<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
	  				<input type="hidden" name="zona" value="<?php echo $_SESSION['user_zona'] ?>">
	  				<div class="absolute flex bottom-4 self-center text-sm text-fbk">
							<button type="submit" class=" rounded-full text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
			      		Publicar <i class="fas fa-paper-plane ml-4 "></i>
			      	</button>
						</div>

					</div>

				</div>

			</form>

                  


			</div>


		</div>

	</div>
</div>

	<script src="<?php echo URLROOT; ?>/js/_usuariop.js"></script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>