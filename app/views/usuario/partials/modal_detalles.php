<div id="modal_detalle_<?php echo $row->id_reserva ?>"  class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
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
						<h2 class="w-40 px-4 text-dark text-xl font-bold "> Profesional :</h2>
						<p class="text-xl "> <?php echo $row->nombre_comercial; ?> </p>
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

					<?php if($row->status == 'cancelado' ) : ?>
						<div class="flex space-x-8 items-center">
							<h2 class="w-40 px-4 text-dark text-xl font-bold ">Motivo :</h2>
							<p class="text-xl"> <?php echo $row->motivo; ?> </p>
						</div>
					<?php endif; ?>
					
				</div>


			<!-- end modal body -->

		</form>
	</div>