	<!-- modal section -->
<?php if($data['page'] == strtolower('sidebar')) : ?>

	<div id="modal_edit_<?php echo $row->item_id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/sidebar" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Editar Item <?php echo $row->item_id ?></h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">
				<!-- nombres apellidos row -->
				<input type="hidden" name="item_id" value="<?php echo $row->item_id ?>">

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="user_rol_id" class="md:w-full"> Agregar al Menu de :</label>
						<select name="user_rol_id" class="p-2 border border-neutral outline-none rounded md:w-full">
							<option selected value="<?php echo $row->user_rol_id ?>"> <?php echo ucwords($row->rol) ?></option>
							<?php foreach($data['roles'] as $row_rol) : ?>
								<option value="<?php echo $row_rol->id?>"> <?php echo ucwords($row_rol->rol) ?></option>
							<?php endforeach; ?>					
							
						</select>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="menu_item_url" class="md:w-full"> URL</label>
						<input type="text" name="menu_item_url" value="<?php echo $row->menu_item_url ?>" class="p-2 border outline-none rounded md:w-full" required>
					</div>

				</div>

				
				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="menu_item_text" class="md:w-full"> Texto del Item</label>
						<input type="text" name="menu_item_text" value="<?php echo $row->menu_item_text ?>" class="p-2 border outline-none rounded md:w-full" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="menu_item_order" class="md:w-full"> N° de orden </label>
						<input type="text" name="menu_item_order" value="<?php echo $row->menu_item_order ?>" class="p-2 border outline-none rounded md:w-full">
					</div>
				</div>

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="menu_item_icon" class="md:w-full"> Icono </label>
						<input type="text" name="menu_item_icon" value="<?php echo $row->menu_item_icon ?>" class="p-2 border outline-none rounded md:w-full">
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="menu_item_status" class="md:w-full">Estado </label>
						<select name="menu_item_status" class="p-2 border outline-none rounded md:w-full">
								<option selected value="<?php echo $row->menu_item_status ?>">
									<?php echo ($row->menu_item_status == 1) ? 'Activo' : 'Inactivo' ; ?>
								 </option>
								<option value="1"> Activo</option>
								<option value="0"> Inactivo</option>
							
						</select>
					</div>
				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_menu_item" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Guardar Cambios</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php elseif($data['page'] == strtolower('usuarios')) : ?>

	<div id="modal_edit_<?php echo $row->user_id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/usuarios" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Editar Usuario</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">
				<!-- nombres apellidos row -->
				<input type="hidden" name="user_id" value="<?php echo $row->user_id ?>">

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="rol_id" class="md:w-full"> Tipo de Usuario :</label>
						<select name="rol_id" class="p-2 border border-neutral outline-none rounded md:w-full">
							<option selected value="<?php echo $row->rol_id ?>"> <?php echo ucwords($row->rol) ?></option>
							<?php foreach($data['roles'] as $row_rol) : ?>
								<option value="<?php echo $row_rol->id?>"> <?php echo ucwords($row_rol->rol) ?></option>
							<?php endforeach; ?>					
							
						</select>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="telefono" class="md:w-full"> Telefono </label>
						<input type="text" name="telefono" value="<?php echo $row->telefono ?>" class="p-2 border outline-none rounded md:w-full" required>
					</div>

				</div>

				
				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="nombre" class="md:w-full"> Nombre </label>
						<input type="text" name="nombre" value="<?php echo $row->nombre ?>" class="p-2 border outline-none rounded md:w-full" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="apellido" class="md:w-full"> Apellido </label>
						<input type="text" name="apellido" value="<?php echo $row->apellido ?>" class="p-2 border outline-none rounded md:w-full">
					</div>
				</div>

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="email" class="md:w-full"> Email </label>
						<input type="text" name="email" value="<?php echo $row->email ?>" class="p-2 border outline-none rounded md:w-full">
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="estado" class="md:w-full">Estado </label>
						<select name="estado" class="p-2 border outline-none rounded md:w-full">
								<option selected value="<?php echo $row->estado ?>">
									<?php echo ($row->estado == 1) ? 'Activo' : 'Inactivo' ; ?>
								 </option>
								<option value="1"> Activo</option>
								<option value="0"> Inactivo</option>
							
						</select>
					</div>
				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_usuario" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Guardar Cambios</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php elseif($data['page'] == strtolower('profesionales')) : ?>

	<div id="modal_edit_<?php echo $row->user_id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/profesionales" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Editar Profesional</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">
				<!-- nombres apellidos row -->
				<input type="hidden" name="user_id" value="<?php echo $row->user_id ?>">

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="rol_id" class="md:w-full"> Tipo de Usuario :</label>
						<select name="rol_id" class="p-2 border border-neutral outline-none rounded md:w-full">
							<option selected value="<?php echo $row->rol_id ?>"> <?php echo ucwords($row->rol) ?></option>
							<?php foreach($data['roles'] as $row_rol) : ?>
								<option value="<?php echo $row_rol->id?>"> <?php echo ucwords($row_rol->rol) ?></option>
							<?php endforeach; ?>					
							
						</select>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="nombre_comercial" class="md:w-full"> Nombre Comercial </label>
						<input type="text" name="nombre_comercial" value="<?php echo $row->nombre_comercial ?>" class="p-2 border outline-none rounded md:w-full" required>
					</div>

				</div>

				
				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="nombre" class="md:w-full"> Nombre </label>
						<input type="text" name="nombre" value="<?php echo $row->nombre ?>" class="p-2 border outline-none rounded md:w-full" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="apellido" class="md:w-full"> Apellido </label>
						<input type="text" name="apellido" value="<?php echo $row->apellido ?>" class="p-2 border outline-none rounded md:w-full">
					</div>
				</div>

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="email" class="md:w-full"> Email </label>
						<input type="text" name="email" value="<?php echo $row->email ?>" class="p-2 border outline-none rounded md:w-full">
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="estado" class="md:w-full">Estado </label>
						<select name="estado" class="p-2 border outline-none rounded md:w-full">
								<option selected value="<?php echo $row->estado ?>">
									<?php echo ($row->estado == 1) ? 'Activo' : 'Inactivo' ; ?>
								 </option>
								<option value="1"> Activo</option>
								<option value="0"> Inactivo</option>
							
						</select>
					</div>
				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_usuario" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Guardar Cambios</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php elseif($data['page'] == strtolower('profesiones')) : ?>

	<div id="modal_edit_<?php echo $row->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/profesiones" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Editar Profesion	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">

				<input type="hidden" name="profesion_id" value="<?php echo $row->id ?>">

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="profesion" class="md:w-full">Profesion </label>
						<input type="text" name="profesion" value="<?php echo $row->profesion ?>" class="p-2 border outline-none rounded md:w-full" placeholder="Escribir profesion" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="estado" class="md:w-full">Estado </label>
						<select name="estado" class="p-2 border outline-none rounded md:w-full">
							<option selected value="<?php echo $row->estado ?>">
								<?php echo ($row->estado == 1) ? 'Activo' : 'Inactivo' ; ?>
							 </option>
							<option value="1"> Activo</option>
							<option value="0"> Inactivo</option>
							
						</select>
					</div>
				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_profesion" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Actualizar Profesion</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>


<?php elseif($data['page'] == strtolower('servicios')) : ?>

	<div id="modal_edit_<?php echo $row->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/servicios/<?php echo $data['servicios'][0]->id_profesion ?>" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Editar Servicio	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">

				<input type="hidden" name="servicio_id" value="<?php echo $row->id ?>">

				<div class="flex flex-col space-y-2 md:flex-row md:space-y-0">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="servicio" class="md:w-full">Servicio </label>
						<input type="text" name="servicio" value="<?php echo $row->servicio ?>" class="p-2 border outline-none rounded md:w-full" placeholder="Escribir Servicio" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="estado" class="md:w-full">Estado </label>
						<select name="estado" class="p-2 border outline-none rounded md:w-full">
							<option selected value="<?php echo $row->estado ?>">
								<?php echo ($row->estado == 1) ? 'Activo' : 'Inactivo' ; ?>
							 </option>
							<option value="1"> Activo</option>
							<option value="0"> Inactivo</option>
							
						</select>
					</div>
				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="edit_servicio" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Actualizar Servicio</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>

<?php elseif($data['page'] == strtolower('condiciones')) : ?>

	<div id="modal_edit_<?php echo $row->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/condiciones" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Agregar Condicion	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">

				<input type="hidden" name="condicion_id" value="<?php echo $row->id ?>">

				<div class="flex flex-col space-y-4 ">
					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="numero" class="md:w-full">Numero </label>
						<input type="text" name="numero" value="<?php echo $row->numero ?>" class="p-2 border outline-none rounded md:w-full" placeholder="Escribir numero" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="titulo" class="md:w-full">Titulo </label>
						<input type="text" name="titulo" value="<?php echo $row->titulo ?>" class="p-2 border outline-none rounded md:w-full" placeholder="Escribir titulo" required>
					</div>

					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label class="md:w-full">Descripcion </label>
		      	<textarea name="descripcion" rows="6"  class="p-2 border outline-none rounded md:w-full" placeholder="Escribe Descripcion " required>
		      		<?php echo $row->descripcion ?>
		      	</textarea>
		      </div>


					<div class="flex flex-col text-dark md:px-3 md:w-full">
						<label for="estado" class="md:w-full">Estado </label>
						<select name="estado" class="p-2 border outline-none rounded md:w-full">
							<option selected value="<?php echo $row->estado ?>">
								<?php echo ($row->estado == 1) ? 'Activo' : 'Inactivo' ; ?>
							 </option>
							<option value="1"> Activo</option>
							<option value="0"> Inactivo</option>
							
						</select>
					</div>
				</div>

			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="update_condicion" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Actualizar Condicion</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>
<?php else: ?>

		<span>nothing</span>

<?php endif; ?>




