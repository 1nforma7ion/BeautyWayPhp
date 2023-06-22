<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full md:w-3/4 bg-neutral  font-dmsans overflow-hidden">
			

			<div class="flex flex-col w-2/3  md:p-4  space-y-8">
				<div class="w-full flex justify-between ">
					<h1 class="text-dark text-2xl text-white ">Mi Perfil </h1>
				</div>

				<div class="group-row">
			    <div class="group-col">
			    	<label for="tipo_documento">Tipo de documento:</label>
				    <input type="text" id="tipo_documento" name="tipo_documento" required value="<?php echo $_SESSION['user_id'] ?>">
			    </div>

			    <div class="group-col relative">
			    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="num_documento">Numero Documento: 
				    	<span id="alert-doc" class="hidden italic text-sm text-red">Maximo <span id="chars_text">2</span> caracteres</span>
				    </label>
				    <input type="text" id="num_documento" name="num_documento"  minlength="3"  required placeholder="46801360">
			    </div>
			  </div>


			</div>

			<div class="w-1/3 flex flex-col space-y-4 ">
			<!-- seccion horarios -->
				<div class="w-full rounded-xl bg-white ">
					<div class="flex flex-col  md:p-4 space-y-4 ">
						<div class="w-full flex justify-between ">
							<h1 class="text-dark text-2xl text-neutral "> Horarios de Atención </h1>
						</div>

						<a href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_turnos' ?>" class="w-max px-4 py-2 bg-ctaDark  cursor-pointer font-bold rounded-xl">
							 <span><i class="fas fa-edit mr-2"></i></span> 
							 <span>Editar Turnos</span> 
						</a>

						<div class="flex flex-col ">
							<?php $semana = getCurrentWeek();	?>
							<?php for ($i = 1; $i <= 7; $i++) :  ?>
								<div class="w-full flex items-center justify-between bg-primary py-2 border-b">

									<div class="w-3/4 flex items-center justify-between ">
										<div class="px-2">
											<i class="fas fa-chevron-right "></i>
											<span ><?php echo $data['dias'][$i] ?> </span>	
										</div>

										<span ><?php echo $semana[$i]; ?> </span>
									</div>

									<div class="w-fit">
										<!-- marcar si el dia esta habilitado en el turnero -->
										<?php setDayStatus(in_array($semana[$i], $data['diasHabiles'])) ?>
									</div>
									
									<?php if(!in_array($semana[$i], $data['diasHabiles'])) : ?>
										<button data-item-edit="<?php echo $i ?>"  class="btn_horario px-2 text-xl text-neutral hover:bg-cta rounded-xl">
											<i class="fas fa-plus-circle"></i>
										</button>
									<?php endif; ?>
									<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_horario.php'; ?>

								</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>

			<!-- seccion profesiones -->
				<div class="w-full rounded-xl bg-white ">
					<div class="flex flex-col   md:p-4  space-y-4">

						<div class="w-full flex justify-between ">
							<h1 class="text-dark text-2xl text-neutral "> Profesion(es) </h1>
						</div>
						
						<button id="btn_add" class="w-44 bg-ctaDark  cursor-pointer p-2 font-bold rounded-xl">
							<i class="fas fa-plus mr-2"></i>Agregar Profesion
						</button>

						<div class="flex flex-col ">

				      <?php if(isset($data['profesiones'])) : ?>
		            <?php foreach ($data['profesiones'] as $row) : ?>
									<div class="w-full flex items-center justify-between bg-primary p-1 border-b">
										<div class="space-x-2">
											<i class="fas fa-chevron-right mr-2"></i>
											<span><?php echo $row->profesion ?></span>
										</div>

										<a href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_profesion/' . $row->id_profesion ?>" class="cursor-pointer p-1 text-2xl hover:bg-cta ">
											<i class="fas fa-edit"></i>
										</a>
									</div>
		            <?php endforeach; ?>
		          <?php endif; ?> 
						</div>

					</div>
				</div>

			</div>


		
		</div>

	</div>
</div>

<?php 

echo "<pre>";
print_r($data);
echo "</pre>";
 ?>

<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_add.php'; ?>


	<script >

window.addEventListener('DOMContentLoaded', ()=> { 

	const allBtnClose = document.querySelectorAll('.btn_close')
  allBtnClose.forEach( btn => {
    btn.addEventListener('click', () => {
      let active_modal = document.querySelector('.active-modal')
      active_modal.classList.toggle('active-modal')
      active_modal.classList.toggle('hidden')
    })
  })

	const allBtnHorario = document.querySelectorAll('.btn_horario')
	allBtnHorario?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.currentTarget.getAttribute('data-item-edit')
			let modalHorario = document.querySelector('#modal_horario_'+id)
			modalHorario.classList.toggle('hidden')
			modalHorario.classList.toggle('active-modal')

		})
	})


})

// end DOMcontentLoaded



const modal_Add = document.querySelector('#modal_add')

const btn_Add = document.querySelector('#btn_add')
btn_Add?.addEventListener('click', () => {
  modal_Add.classList.toggle('hidden')
  modal_Add.classList.toggle('active-modal')
  // console.log(modal_Add)
})



window.addEventListener('click', (e) => {
  let activeModal = document.querySelector('.active-modal')
  if (e.target == activeModal) {
    activeModal.classList.toggle('active-modal')
    activeModal.classList.toggle('hidden')
  }
})


if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

	</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 