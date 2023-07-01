
	<div id="modal_responder_<?php echo $row->mensaje_id ?>" class="hidden fixed inset-0 overflow-y-auto w-full h-screen bg-dark pt-24 px-2 py-5 bg-opacity-70">
		<form action="<?php echo URLROOT; ?>/usuario/mensajes" method="post" autocomplete="off"  class="flex flex-col py-4 space-y-4 w-full mx-auto md:max-w-2xl bg-white shadow rounded-lg font-dmsans text-neutral">
			<!-- modal title -->
			<div class="flex justify-between px-6 py-2 border-b md:px-6 md:py-2">
				<h2 class="text-dark text-lg font-bold text-center">Responder Mensaje	</h2>
				<span class="btn_close cursor-pointer text-2xl"><i class="fas fa-xmark"></i></span>
			</div>

			<!-- start modal body -->
			<div class="flex flex-col w-full px-4 space-y-2 ">

				<input type="hidden" name="recibido_por" value="<?php echo $row->enviado_por ?>">

				<div class="w-full flex flex-col space-y-4 justify-around">
					<span class="text-xl font-bold text-dark">Enviado por : <?php echo $row->nombre_comercial ?></span>

		      <div class="w-full px-2  border-2 border-primary">
		      		<span class="text-xl text-dark">Mensaje: </span><?php echo $row->mensaje ?>
		      </div>

		      <div class="w-full">
		      	<textarea name="mensaje" id="mensaje" rows="6"  class="w-full px-2 resize-none outline-none focus:border-neutral border-2 border-primary " placeholder="Escribe respuesta " required></textarea>
		      </div>

				</div>

			</div>

			<div class="flex flex-col py-4 w-full items-center text-lg font-bold md:flex-row md:justify-around md:space-y-0">
				<button name="responder_mensaje" type="submit" class="w-1/2 p-3 rounded-xl text-dark bg-ctaLight hover:bg-ctaDark md:w-1/2 border">Enviar Mensaje</button>
			</div>
			<!-- end modal body -->

		</form>
	</div>





