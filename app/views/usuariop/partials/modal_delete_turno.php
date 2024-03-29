
	<div id="modal_delete_<?php echo $row_turno->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/edit_turnos" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans text-neutral">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Eliminar Turno </h2>
				<span class="btn_close_turno cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<input type="hidden" name="id_dia" value="<?php echo $row_turno->id ?>">
	
			<div class="flex flex-col justify-center items-center text-xl w-full px-6 space-y-4 ">
				<span><?php echo ' Dia : ' . $row_turno->dia ?> </span>
				<span><?php echo ' Hora Inicio : ' . $row_turno->hora_inicio ?> </span>
				<span><?php echo ' Hora Fin : ' . $row_turno->hora_fin ?> </span>
			</div>


			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="delete_horario" type="submit" class="w-1/2 p-3 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Eliminar Turno </button>
			</div>
			<!-- end modal body -->

		</form>
	</div>
