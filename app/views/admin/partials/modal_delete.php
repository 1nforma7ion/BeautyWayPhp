	<!-- modal section -->
<?php if($data['page'] == strtolower('sidebar')) : ?>

	<div id="modal_delete_<?php echo $row->item_id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/sidebar" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">

			<input type="hidden" name="item_id_delete" value="<?php echo $row->item_id ?>">

			<div class="flex justify-between px-6 py-2 md:px-6 md:py-2">
				<div class="w-full flex flex-col space-y-4">
					<h2 class="text-dark text-lg font-bold text-center">SEGURO QUE DESEA ELIMINAR : </h2>
					<span class="text-center text-4xl"><?php echo $row->menu_item_text ?></span>
				</div>
				
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>


			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="delete_menu_item" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Eliminar Item</button>
			</div>

		</form>
	</div>

<?php elseif($data['page'] == strtolower('usuarios')) : ?>

	<div id="modal_delete_<?php echo $row->user_id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/usuarios" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">

			<input type="hidden" name="usuario_id" value="<?php echo $row->user_id ?>">

			<div class="flex justify-between px-6 py-2 md:px-6 md:py-2">
				<div class="w-full flex flex-col space-y-4">
					<h2 class="text-dark text-lg font-bold text-center">SEGURO QUE DESEA ELIMINAR : </h2>
					<span class="text-center text-4xl"><?php echo $row->nombre . ' ' . $row->apellido ?></span>
				</div>
				
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>


			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="delete_usuario" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Eliminar Usuario</button>
			</div>

		</form>
	</div>

<?php elseif($data['page'] == strtolower('profesionales')) : ?>

	<div id="modal_delete_<?php echo $row->user_id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/profesionales" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">

			<input type="hidden" name="usuario_id" value="<?php echo $row->user_id ?>">

			<div class="flex justify-between px-6 py-2 md:px-6 md:py-2">
				<div class="w-full flex flex-col space-y-4">
					<h2 class="text-dark text-lg font-bold text-center">SEGURO QUE DESEA ELIMINAR : </h2>
					<span class="text-center text-4xl"><?php echo $row->nombre . ' ' . $row->apellido ?></span>
				</div>
				
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>


			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="delete_usuario" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Eliminar Profesional</button>
			</div>

		</form>
	</div>

<?php elseif($data['page'] == strtolower('profesiones')) : ?>

	<div id="modal_delete_<?php echo $row->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/profesiones" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">

			<input type="hidden" name="profesion_id" value="<?php echo $row->id ?>">

			<div class="flex justify-between px-6 py-2 md:px-6 md:py-2">
				<div class="w-full flex flex-col space-y-4">
					<h2 class="text-dark text-lg font-bold text-center">SEGURO QUE DESEA ELIMINAR : </h2>
					<span class="text-center text-4xl"><?php echo $row->profesion ?></span>
				</div>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
				
			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="delete_profesion" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Eliminar Profesion</button>
			</div>

		</form>
	</div>

<?php elseif($data['page'] == strtolower('servicios')) : ?>

	<div id="modal_delete_<?php echo $row->id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/admin/servicios" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans">

			<input type="hidden" name="profesion_id" value="<?php echo $row->id ?>">

			<div class="flex justify-between px-6 py-2 md:px-6 md:py-2">
				<div class="w-full flex flex-col space-y-4">
					<h2 class="text-dark text-lg font-bold text-center">SEGURO QUE DESEA ELIMINAR : </h2>
					<span class="text-center text-4xl"><?php echo $row->servicio ?></span>
				</div>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
				
			</div>

			<div class="flex flex-col w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="delete_profesion" type="submit" class="w-2/4 p-4 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Eliminar Servicio </button>
			</div>

		</form>
	</div>

<?php else: ?>

		<span>Nothing</span>

<?php endif; ?>

