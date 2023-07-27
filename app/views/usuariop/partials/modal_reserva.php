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

<?php elseif($data['page'] == strtolower('reservas')) : ?>

	<div id="modal_edit_reserva_<?php echo $row->id_reserva ?>"  class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/reservas" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Detalles Reserva	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">

				<input type="hidden" name="id_reserva" value="<?php echo $row->id_reserva ?>">
				<input type="hidden" name="dia" value="<?php echo $row->dia ?>">
				<input type="hidden" name="hora_inicio" value="<?php echo $row->hora_inicio ?>">

				<div class="flex flex-col space-y-4  text-dark md:p-4">
					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Servicio :</h2>
						<p class="text-xl"> <?php echo $row->servicio ?> </p>
					</div>

					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Cliente :</h2>
						<p class="text-xl "> <?php echo $row->nombre . ' ' . $row->apellido; ?> </p>
					</div>

					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Modalidad :</h2>
						<p class="text-xl"> <?php echo $row->reserva_modalidad ?> </p>
					</div>

					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Dirección :</h2>
						<p class="text-xl"> <?php echo $row->reserva_direccion ?> </p>
					</div>

					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Dia :</h2>
						<p class="text-xl"> <?php echo $row->dia ?> </p>
					</div>

					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Turno :</h2>
						<p class="text-xl"> <?php echo $row->hora_inicio . ' hrs'?> </p>
					</div>

					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Estado :</h2>
						<p class="text-xl"> <?php setReservaStatus($row->status); ?> </p>
					</div>

				</div>

				<div class="flex flex-col py-2 space-y-2 md:flex-row md:space-y-0 border-t-4 border-dark ">
					

					<div class="flex flex-col space-y-8 mx-auto text-dark md:px-3 md:w-1/2">
            <select id="status_<?php echo $row->id_reserva ?>" name="status" required class="p-2 rounded-xl text-lg outline-none bg-primary">
              <option value="" selected>Seleccionar Estado</option>
              <?php if(isset($data['reservas_estados'])) : ?>
                <?php foreach ($data['reservas_estados'] as $row_reserva) : ?>
                  <option value="<?php echo $row_reserva->estado ?>"><?php echo $row_reserva->estado ?></option>
                <?php endforeach; ?>
              <?php endif; ?> 
            </select>
					
            <select id="motivo_<?php echo $row->id_reserva ?>" name="motivo" class="hidden p-2 rounded-xl text-lg outline-none bg-primary">
              <option value="" selected>Seleccionar motivo </option>
              <?php if(isset($data['reservas_motivos'])) : ?>
                <?php foreach ($data['reservas_motivos'] as $row) : ?>
                  <option value="<?php echo $row->motivo ?>"><?php echo $row->motivo ?></option>
                <?php endforeach; ?>
              <?php endif; ?> 
            </select>
					</div>

				</div>

			</div>

			<div class="flex flex-col py-2 w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_reserva" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Actualizar Reserva</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php else: ?>

	<span>nothing</span>

<?php endif; ?>
