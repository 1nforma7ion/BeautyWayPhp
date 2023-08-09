
	<div id="modal_edit_<?php echo $row->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<div  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans text-neutral">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center"> Turnos Dia <?php echo $row->dia ?>	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">
				<?php $i=1; ?>
				<?php foreach($data['horarios'] as $row_turno): ?>  
	         <?php if ( $row->dia == $row_turno->dia ) : ?>

							<div class="w-full flex items-center justify-between bg-primary p-2">
								<div class="flex w-3/4 justify-around ">
									
									<span class="text-dark text-xl"><?php echo 'Turno n° ' . $i++  ?></span>
									<span><?php echo 'Hora inicio : ' . $row_turno->hora_inicio ?></span>
									<span><?php echo 'Hora fin : ' . $row_turno->hora_fin ?></span>
								</div>

								<button data-item-edit-turno="<?php echo $row_turno->id ?>"  class="btn_edit_turno text-neutral text-2xl"><i class="fas fa-edit "></i></button>
								<button data-item-delete="<?php echo $row_turno->id ?>" class="btn_delete text-red text-2xl"><i class="fas fa-trash"></i>	</button>   
							</div>

							<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_edit_turno.php'; ?>
							<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_delete_turno.php'; ?>

					<?php endif; ?>
	      <?php endforeach; ?>            

			</div>

			<!-- end modal body -->

		</div>
	</div>





