<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
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