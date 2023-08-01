<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full md:w-3/4 overflow-hidden">

			<div class="flex flex-col w-full  md:p-4  space-y-4  overflow-y-scroll no-scrollbar">


			<?php if(isset($data['servicios']) ) : ?>
				<form action="<?php echo URLROOT . '/' . $data['controller'] . '/publicar/' . $data['profesion']->id ?>" autocomplete="off" method="POST" enctype="multipart/form-data">
					<div class=" flex flex-col-reverse md:flex-row bg-white text-darkborder drop-shadow-lg hover:drop-shadow-card rounded-lg font-dmsans">

						<div class="img_post relative flex w-full md:w-2/3 items-center font-dmsans bg-primary">
							<canvas id="preview" class=" w-full h-72 md:h-96 "></canvas>

							<div class="date_post absolute w-max h-max bottom-4 right-0 md:top-4 md:left-0 rounded-r-lg text-sm text-dark p-2 bg-ctaDark font-bold drop-shadow-card">
								<div class="w-full text-center text-2xl">
									<span><?php echo $data['profesion']->profesion ?></span>
								</div>
								<select id="servicio" name="servicio" required class="p-2 rounded-xl text-lg outline-none bg-ctaDark" required>
	                <option value="" selected>Seleccionar Servicio</option>
	                <?php if(isset($data['servicios'])) : ?>
	                  <?php foreach ($data['servicios'] as $row) : ?>
	                    <option value="<?php echo $row->servicio ?>"><?php echo $row->servicio ?></option>
	                  <?php endforeach; ?>
	                <?php endif; ?> 
	              </select>

							</div>

							<div class="absolute w-full flex justify-around items-center h-max bottom-6 left-0 ">
								<div class="w-1/3 p-3 flex justify-between font-bold rounded-xl  bg-ctaDark text-dark drop-shadow-card">
									<input id="img-input" type="file" name="imagen" hidden required>
									<label for="img-input" class="w-full cursor-pointer text-center font-bold text-dark drop-shadow-card"> 
				            <span >Subir Imagen  <i class="fas fa-image"></i> </span>
				          </label>	 
			          </div>

			          <div class="w-max p-3 flex items-center space-x-4  font-bold rounded-xl  bg-ctaDark text-dark drop-shadow-card">
			          	<label for="descuento">Descuento en % </label>
									<input type="text" name="descuento" id="descuento" placeholder="0" class=" w-12 outline-none focus:border-neutral border-2 border-primary " >
			          </div>


							</div>
						</div>
											
						<div class="relative md:h-96 w-full flex flex-col p-4 md:w-1/3 space-y-4 ">
							<div class="flex space-x-4">
								<div class="flex flex-col space-y-4">
									<div class="w-full flex items-center space-x-4">
										<?php if (!empty($data['imagenes_perfil'])) : ?>
											<img src="<?php echo URLROOT . $data['imagenes_perfil']->imagen_comercial ?>" class="h-16 w-16 rounded-full object-cover ">
										<?php else: ?>
											<img src="<?php echo URLROOT . '/img/user.png' ?>" alt="imagen usuario" class="h-16 w-16 rounded-full object-cover ">
										<?php endif; ?>
										
										<h1 ><a href="" class="text-dark hover:text-fbk text-xl  font-bold"><?php echo !is_null($_SESSION['user_nombre_comercial']) ? $_SESSION['user_nombre_comercial'] : '' ?></a></h1>
									</div>

								</div>

							</div>
				      <div class="w-full">
				      	<textarea name="descripcion" id="descripcion" rows="8"  class="w-full px-2 resize-none outline-none focus:border-neutral border-2 border-primary " placeholder="Escribe el contenido de la publicacion " required></textarea>
				      </div>
		  				
		  				<div class="absolute flex bottom-4 self-center text-sm text-fbk">
								<button type="submit" class=" rounded-full text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
				      		Publicar <i class="fas fa-paper-plane ml-4 "></i>
				      	</button>
							</div>

						</div>

					</div>

				</form>
			<?php else: ?>


				<?php if(count($data['horarios']) < 1 || empty($data['imagenes_perfil']) ) : ?>
					<div class="w-full h-96 flex flex-col space-y-8 items-center justify-center bg-white rounded-xl text-2xl font-dmsans">
						<span>Debes configurar tu imagen de perfil y horario antes de Publicar:  </span>
						<a href="<?php echo URLROOT . '/' . $data['controller']; ?>/perfil" class="py-2 px-4 rounded-full bg-neutral text-white">  Ir a mi Perfil <i class="fas fa-arrow-right"></i></a>
					</div>

				<?php else: ?>
				<!-- seccion profesiones -->
					<div class="w-1/2 self-center rounded-xl bg-white ">
						<div class="flex flex-col   md:p-4  space-y-4">

							<div class="w-full flex justify-between ">
								<h1 class="text-dark text-2xl text-neutral "> Selecciona una Profesion :</h1>
							</div>
							
							<div class="flex flex-col ">

					      <?php if(isset($data['profesiones'])) : ?>
			            <?php foreach ($data['profesiones'] as $row) : ?>
										<div class="w-full flex items-center justify-between bg-primary p-1 border-b">
											<div class="space-x-2">
												<i class="fas fa-chevron-right mr-2"></i>
												<span><?php echo $row->profesion ?></span>
											</div>

											<a href="<?php echo URLROOT . '/' . $data['controller'] . '/publicar/' . $row->id_profesion ?>" class="cursor-pointer p-1 text-2xl hover:bg-cta ">
												<i class="fas fa-arrow-right"></i>
											</a>
										</div>
			            <?php endforeach; ?>
			          <?php endif; ?> 
							</div>

						</div>
					</div>
				<?php endif; ?>


			<?php endif; ?>
			</div>


		</div>

	</div>
</div>


<?php 
// echo "<pre>";


// print_r($data);
// print_r($_SESSION);

 ?>
	<script>
		// cargar imagen con javascript
const inputImage = document.getElementById('img-input')
inputImage.type = 'file'
inputImage.accept = 'image/*'

inputImage.addEventListener('change', fileEvent => {
  const file = fileEvent.target.files[0]
  const reader = new FileReader()

  reader.addEventListener('load', readerEvent => {
    const image = new Image()
    image.addEventListener('load', drawImage)
    image.src = readerEvent.target.result;
  })

  reader.readAsDataURL(file, "UTF-8")
})


// funcion para dibujar la imagen, arrow function no es una opción porque no permite usar "this", fuera del scope del objeto
function drawImage() {
  const preview = document.getElementById('preview')
  const ctx = preview.getContext('2d')

  // this es la imagen que carga con el evento "onload"
  preview.width = this.naturalWidth;
  preview.height = this.naturalHeight;
  ctx.drawImage(this, 0, 0, this.width, this.height);
}

	</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>