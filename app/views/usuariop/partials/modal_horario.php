	<!-- modal section -->
<?php if($data['page'] == strtolower('perfil')) : ?>

	<div id="modal_horario_<?php echo $i ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/perfil" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Activar : <?php echo $data['dias'][$i] . ' ' . $semana[$i]  ?></h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>


			<!-- start modal body -->
			<input type="hidden" name="dia" value="<?php echo $semana[$i] ?>">
			<input type="hidden" name="dia_nombre" value="<?php echo $data['dias'][$i] ?>">

			<div class="flex flex-col text-dark md:px-6 md:w-full">
				<label for="estado" class="md:w-full">Confirmar si habrá atención :  </label>
				<select name="estado" class="p-2 border outline-none rounded md:w-full" required>
					<option selected value="" disabled>Seleccionar...</option>
						<option value="1"> Si habra atencion</option>
						<option value="0"> No habrá atencion</option>
				</select>
			</div>


			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="add_horario" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Guardar Cambios</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php elseif($data['page'] == strtolower('edit_turnos')) : ?>


	<div id="modal_turno_<?php echo $row->dia_nombre ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/edit_turnos" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Añadir turno <?php echo $row->dia_nombre . ' ' . $row->dia ?></h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<input type="hidden" name="dia" value="<?php echo $row->dia ?>">
			<input type="hidden" name="dia_nombre" value="<?php echo $row->dia_nombre ?>">

			<div class="flex w-full px-6 space-x-8 ">

				<div class="flex flex-col space-y-4 w-1/2">
					<label for="apertura">Hora de Apertura</label>
					<input type="time" name="apertura" value="06:00" class="p-2 bg-primary" >
				</div>

				<div class="flex flex-col space-y-4 w-1/2">
					<label for="cierre">Hora de Cierre</label>
					<input type="time" name="cierre" value="22:00" class="p-2 bg-primary" >
				</div>
				
			</div>


			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="add_turno" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Crear Turno</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php else: ?>

	<span>nothing</span>

<?php endif; ?>
