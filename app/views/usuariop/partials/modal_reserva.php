	<!-- modal section -->
<?php if($data['page'] == strtolower('editar')) : ?>

	<div id="modal_reserva_<?php echo $row->id_public ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/editar" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans text-neutral">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Confirmar </h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>


			<input type="hidden" name="id_public" value="<?php echo $row->id_public ?>">

			<div class="flex flex-col items-center text-xl w-full px-6 space-x-8 ">
				<span>Seguro que desea Archivar la publicacion ?  </span>
				<span class="py-2 text-2xl text-dark">Servicio : <?php echo $row->servicio ?> </span>
				<span class="py-2 text-2xl text-dark">Descuento - <?php echo $row->descuento  ?> % </span>
			</div>


			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_public" type="submit" class="w-1/2 p-3 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Archivar Publicacion</button>
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
				<input type="hidden" name="servicio" value="<?php echo $row->servicio ?>">
				<input type="hidden" name="nombre_cliente" value="<?php echo $row->nombre . ' ' . $row->apellido; ?>">
				<input type="hidden" name="id_usuario" value="<?php echo $row->id_usuario ?>">
				<input type="hidden" name="modalidad" value="<?php echo $row->reserva_modalidad ?>">
				<input type="hidden" name="direccion" value="<?php echo $row->reserva_direccion ?>">

				<div class="flex flex-col space-y-4  text-dark md:p-4">
					<div class="flex space-x-8 items-center">
						<h2 class="w-40 px-4 text-dark text-xl font-bold ">Servicio :</h2>
						<p class="text-xl"> <?php echo ucwords($row->servicio) ?> </p>
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

					<?php if($row->status == 'cancelado' ) : ?>
						<div class="flex space-x-8 items-center">
							<h2 class="w-40 px-4 text-dark text-xl font-bold ">Motivo :</h2>
							<p class="text-xl"> <?php echo $row->motivo; ?> </p>
						</div>
					<?php endif; ?>

				</div>
				<?php if($row->status == 'pendiente' || $row->status == 'confirmado') : ?>
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
                <?php foreach ($data['reservas_motivos'] as $row_motivo) : ?>
                  <option value="<?php echo $row_motivo->motivo ?>"><?php echo $row_motivo->motivo ?></option>
                <?php endforeach; ?>
              <?php endif; ?> 
            </select>
					</div>

				</div>
				<?php endif; ?>

			</div>

			<?php if($row->status == 'pendiente' || $row->status == 'confirmado') : ?>
			<div class="flex flex-col py-2 w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_reserva" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Actualizar Reserva</button>
			</div>
			<?php endif; ?>
			<!-- end modal body -->

		</form>
	</div>

<?php else: ?>

	<span>nothing</span>

<?php endif; ?>
