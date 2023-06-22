
<?php if($data['page'] == strtolower('perfil')) : ?>


	<div id="modal_add" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuariop/perfil" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Agregar Profesion	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">


				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
            <select id="profesion" name="profesion" required class="p-2 rounded-xl text-lg outline-none bg-primary">
              <option value="" selected>Seleccionar profesion</option>
              <?php if(isset($data['listaProfesiones'])) : ?>
                <?php foreach ($data['listaProfesiones'] as $row) : ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->profesion ?></option>
                <?php endforeach; ?>
              <?php endif; ?> 
            </select>
					</div>


				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="add_profesion" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Agregar Profesion</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php elseif($data['page'] == strtolower('servicios')) : ?>

	<div id="modal_add" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/servicios/<?php echo $data['servicios'][0]->id_profesion ?>" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Agregar Servicio	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="servicio" class="md:w-full">Servicio<?php echo $data['servicios'][0]->id_profesion ?> </label>
						<input type="text" name="servicio" class="p-2 border outline-none rounded md:w-full" placeholder="Escribir servicio" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="estado" class="md:w-full">Estado </label>
						<select name="estado" class="p-2 border outline-none rounded md:w-full">
							<option selected disabled>Seleccionar...</option>

								<option value="1"> Activo</option>
								<option value="0"> Inactivo</option>
							
						</select>
					</div>
				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="add_servicio" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Agregar Servicio</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php else: ?>

		<span>nothg</span>

<?php endif; ?>
