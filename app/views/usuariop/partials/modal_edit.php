
	<div id="modal_edit_<?php echo $row->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/edit_turnos" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans text-neutral">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Editar Dia <?php echo $row->dia ?>	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">

				<input type="hidden" name="id_dia" value="<?php echo $row->id ?>">

				<div class="w-full flex justify-around">

					<div class="flex flex-col space-y-4 w-max">
						<label for="hora_inicio">Hora de Apertura</label>
						<select id="hora_inicio" name="hora_inicio" required class="p-2 rounded-xl text-lg outline-none bg-primary" required>
							<option value="<?php echo $row->hora_inicio ?>"><?php echo $row->hora_inicio ?></option>
	            <?php if(isset($data['horas'])) : ?>
	              <?php foreach ($data['horas'] as $row_horas_1) : ?>
	                <option value="<?php echo $row_horas_1->hora ?>"><?php echo $row_horas_1->hora ?></option>
	              <?php endforeach; ?>
	            <?php endif; ?> 
	          </select>
					</div>

					<div class="flex flex-col space-y-4 w-max">
						<label for="hora_fin">Hora de Cierre</label>
						<select id="hora_fin" name="hora_fin" required class="p-2 rounded-xl text-lg outline-none bg-primary" required>	
							<option value="<?php echo $row->hora_fin ?>"><?php echo $row->hora_fin ?></option>
							
	            <?php if(isset($data['horas'])) : ?>
	              <?php foreach ($data['horas'] as $row_horas_2) : ?>
	                <option value="<?php echo $row_horas_2->hora ?>"><?php echo $row_horas_2->hora ?></option>
	              <?php endforeach; ?>
	            <?php endif; ?> 
	          </select>
					</div>

				</div>

			</div>

			<div class="flex flex-col py-4 w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="update_horario" type="submit" class="w-1/2 p-3 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Actualizar Horario</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>





