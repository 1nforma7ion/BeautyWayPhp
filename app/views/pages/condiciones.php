<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

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
		<div class="flex w-full md:w-3/4 overflow-hidden">

			<div class="flex flex-col w-full  md:p-4  space-y-4  overflow-y-scroll no-scrollbar">

				<div class="w-full flex flex-col space-y-8 items-center justify-center bg-white rounded-xl text-2xl font-dmsans">
					<div class="w-full md:p-8 flex flex-col p-4 space-y-4">
						<span class="text-neutral text-4xl text-center py-2">Bases y Condiciones de la  </span>
						<span class="text-neutral text-4xl text-center py-2"> Red Social de Belleza "Beauty Way" </span>

            <?php foreach($data['condiciones'] as $row): ?>
            	<div class="w-full px-10 py-4 flex flex-col space-y-2">
            		<div class="flex space-x-2">
            			<h3 class="text-2xl"><?php echo $row->numero; ?> </h3>
	              	<p class="text-2xl"><?php echo $row->titulo; ?> </p>
            		</div>
	              	<p class="text-lg px-4"><?php echo nl2br($row->descripcion); ?> </p>

            	</div>
	                
            <?php endforeach; ?>  

						
					</div>

				</div>

			</div>


		</div>

	</div>
</div>


<?php 
// echo "<pre>";


// print_r($data);
// print_r($_SESSION);

 ?>



<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>