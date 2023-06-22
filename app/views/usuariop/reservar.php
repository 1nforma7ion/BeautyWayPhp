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
			
			<div class="w-full p-4 bg-white flex flex-col rounded-xl ">

				
				<div class="w-full flex px-4 pt-4">	
					<div class="w-full bg-neutral text-white text-4xl text-center">
						<?php echo getMes(); ?>
					</div>
				</div>


				<div class="w-full flex  px-4 items-center">
					<?php if ($data['horarios']) : ?>
						<?php foreach($data['horarios'] as $row) : ?>

							<div class="flex w-44 flex-col bg-primary ">
								<span class="text-center text-xl py-1"><?php echo $row->dia_nombre ?></span>
								<div class="text-center text-xl border-b py-1">
									<?php
										$dia = explode('-',$row->dia);
										$dia = $dia[0] . '/' . $dia[1];

										echo  $dia; 
									?>
								</div>
							</div>

						<?php	endforeach; ?>
					<?php endif; ?>
				</div>

				<div class="w-full flex  px-4 items-center">
					<?php if ($data['horarios']) : ?>
						<?php foreach($data['horarios'] as $row) : ?>

							
							<div class="flex w-44 flex-col bg-primary h-full">
								<?php 
									$hoy = date('d'); 
									$dia = explode('-',$row->dia);
									$dia = $dia[0]  
								?>
								<!-- Si el dia ya paso se marca como -->
								<?php if($dia < $hoy) : ?>
									<span class="text-center text-lg px-6 py-10">Finalizado.</span>
								<?php else: ?>
										
									<?php if($row->estado == 1) : ?>
										<span class="text-center text-lg "><?php echo $row->apertura ?> </span>
										<span class="text-center text-lg "><?php echo $row->cierre ?></span>
										<button data-item-edit=""  class="btn_horario p-1 hover:bg-cta rounded-xl">
											<i class="fas fa-plus-circle mr-2"></i> Turno
										</button>
									<?php else : ?>
										<span class="text-center text-lg px-6 py-10">No hay atencion.</span>
									<?php endif; ?>

								<?php endif; ?>

							</div>

						<?php	endforeach; ?>
					<?php else: ?>
						<span>No hay horarios disponibles.</span>
					<?php endif; ?>

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


	</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 