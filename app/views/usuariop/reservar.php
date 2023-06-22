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
					<div class="w-full bg-neutral text-white text-4xl py-4 text-center">
						<?php echo getMes(); ?>
					</div>
				</div>

				<div class="w-full flex  px-4 items-center ">
					<?php if ($data['horarios']) : ?>
						<?php foreach($data['horarios'] as $row) : ?>

							<div class="flex w-44 flex-col bg-primary border-r border-neutral">
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

							
							<div class="flex w-44 flex-col space-y-2 py-2 bg-primaryDark h-full border-r  border-neutral">
								<?php 
									$hoy = date('d'); 
									$dia = explode('-',$row->dia);
									$dia = $dia[0]  
								?>
								<!-- Si el dia ya paso se marca como Finalizado -->
								<?php if($dia < $hoy) : ?>
									<span class="text-center text-lg md:px-6 md:py-10">Finalizado.</span>
								<?php else: ?>
										
									<!-- mostrar los turnos creados -->
									<?php foreach($data['turnos'] as $unit) : ?>
										<?php if($row->dia == $unit->dia) : ?>
											<div class="w-full flex justify-center">
												<button data-item-edit="<?php echo $unit->id ?>"  class="btn_reserva self-center w-11/12 p-2 bg-white text-neutral rounded-xl" >
													<span> <?php echo $unit->apertura . ' hrs' ?> </span> 
												</button>
												<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_reserva.php'; ?>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>



								<?php endif; ?>

							</div>

						<?php	endforeach; ?>
					<?php else: ?>
						<div class="w-full p-4 text-xl font-bold text-center">No hay horarios disponibles.</div>
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

	const allBtnTurno = document.querySelectorAll('.btn_turno')
	allBtnTurno?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.currentTarget.getAttribute('data-item-edit')
			let modalHorario = document.querySelector('#modal_turno_'+id)
			modalHorario.classList.toggle('hidden')
			modalHorario.classList.toggle('active-modal')

		})
	})

	const allBtnReserva = document.querySelectorAll('.btn_reserva')
	allBtnReserva?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.currentTarget.getAttribute('data-item-edit')
			let modalReserva = document.querySelector('#modal_reserva_'+id)
			modalReserva.classList.toggle('hidden')
			modalReserva.classList.toggle('active-modal')

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