	<!-- modal section -->
<?php if($data['page'] == strtolower('reservar')) : ?>

	<div id="modal_reserva_<?php echo $unit->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark mt-0 pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/reservar" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-4xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-4xl font-bold text-center">Confirmación de la Reserva</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>


			<!-- start modal body -->
			<input type="hidden" name="dia" value="">
			<input type="hidden" name="dia_nombre" value="">

			<div class="flex flex-col text-dark md:px-6 md:w-full">
				<label for="estado" class="md:w-full">Confirmar si habrá atención :  </label>
				<select name="estado" class="p-2 border outline-none rounded md:w-full" required>
					<option selected value="" disabled>Seleccionar...</option>
						<option value="1"> Si habra atencion</option>
						<option value="0"> No habrá atencion</option>
				</select>
			</div>


			<div class="flex flex-col w-full p-4 items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button class="btn_close w-full space-x-2 p-3 rounded-xl text-dark bg-red text-white md:w-1/4 border">
					<i class="fas fa-xmark"></i>
					<span>Cancelar</span>
				</button>

				<button name="add_reserva" type="submit" class="w-full p-3 space-x-2 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-2/3 border">
					<i class="fas fa-check"></i>
					<span>Confirmar Reserva</span>
				</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>


<?php else: ?>

	<span>nothing</span>

<?php endif; ?>
