<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>





		<!-- columna DERECHA -->
		<div id="col-der" class="hidden md:block md:p-4 md:w-full">
			<div class="flex md:w-[1200px] w-screen mx-auto">

				<div class="relative flex w-full overflow-hidden bg-neutralLight h-[760px] ">

					<button id="prev" class="z-20 absolute self-center h-max rounded-lg p-3 text-dark bg-cta opacity-20 hover:opacity-90 text-4xl font-bold">
				  	<i class="fas fa-chevron-left ml-2"></i>
				  </button>

		  		<?php $total = FREE_PAGES; ?>
					<?php for ($i = 1; $i < $total+1; $i++) : ?>
						<div class="slide absolute">
							<div class="flex flex-col items-center">
								
						  	<div class="flex flex-col md:flex-row w-full p-4 justify-between text-xl">
									<button class="w-full mx-auto md:w-1/2 p-2 rounded-xl bg-cta text-dark font-bold"><?php echo ' :  Pag. ' . $i . ' de ' . $total ?></button>
								</div>  
								
							  <img src="<?php echo URLROOT . '/img/free/capitulo_1/' . $i . '.png' ?>" alt="imagen logo" class="object-cover md:w-[1200px]">

						  </div>
						</div>
					<?php endfor; ?>

					<button id="next" class="z-20 right-0 absolute self-center rounded-lg p-3 text-dark bg-cta opacity-20 hover:opacity-90 text-4xl font-bold">
						<i class="fas fa-chevron-right ml-2"></i>
					</button>

				</div>

			</div>
		</div>





</div>

<script src="<?php echo URLROOT; ?>/js/carousel.js"></script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>