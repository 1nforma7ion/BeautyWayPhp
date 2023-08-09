<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full ">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full flex flex-col md:flex-row md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="w-full md:w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex flex-col p-4 space-y-4 w-full md:w-3/4 font-dmsans">

			<div class="w-full p-4 h-screen bg-white flex flex-col rounded-xl ">
				<!-- Tabla Datatable -->
				<div class="w-full flex justify-between py-4 text-2xl text-neutral text-center">
					<h2 class="text-4xl">Mis Reservas</h2>
					<div class="w-1/3">
						
						<?php showMsg(); ?>
						
					</div>  
				</div>

				<div class="w-full  bg-primary rounded-lg ">
					<table class="bg-white datatable " >
	          <thead>
	            <tr>
	              <th>Servicio</th>
	              <th>Cliente</th>
	              <th>Dia</th>
	              <th>Turno</th>
	              <th>Estado</th>
	              <th>Opciones</th>
	            </tr>
	          </thead>
	          
	          <tbody >
	          	<?php if(!empty($data['reservas'])) : ?>
	            <?php foreach($data['reservas'] as $row): ?>
	             <tr>
	                <td> <div class="w-full"> <?php echo $row->servicio; ?></div> </td>
	                <td><div class="w-max"><?php echo $row->nombre . ' ' . $row->apellido; ?></div> </td>
	                <td> <div class="w-max "> <?php echo $row->dia; ?></div> </td>
	                <td><div class="w-max  "><?php echo $row->hora_inicio; ?> </div></td>
	                <td><div class="w-max  "><?php setReservaStatus($row->status); ?> </div></td>
	                
	                <td>
	                	<?php if($row->status == 'cancelado' || $row->status == 'finalizado') : ?>
	                	<div class="w-max flex items-center justify-center ">
	             		    <button data-item-edit="<?php echo $row->id_reserva ?>"  class="btn_reserva ">
	             		    	<i class="fas fa-plus-circle text-2xl text-neutral"></i>
	             		    </button>
		                		 		
		                	</div>
	                		<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_reserva.php'; ?>
	                		 		
	                	</div>
	                	
	                	<?php else : ?>
	                		<div class="w-max flex ">
		             		    <button data-item-edit="<?php echo $row->id_reserva ?>"  class="btn_reserva text-white bg-neutral px-2 rounded ">
		             		    	<i class="fas fa-gear"></i>
		             		    </button>
		                		 		
		                	</div>
	                		<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_reserva.php'; ?>

	                	<?php endif; ?>
	                </td>
	             </tr>

	            <?php endforeach; ?> 
							<?php endif; ?>

	          </tbody>
	      	</table>
				</div>
			</div>

		</div>

	</div>
</div>

<?php 

echo "<pre>";
// print_r($data);
echo "</pre>";
 ?>




	<script >

window.addEventListener('DOMContentLoaded', ()=> {

 	const successAlert = document.querySelector('#success_msg')
  	setTimeout(() => {
    	successAlert?.remove()
  	}, 5000)
  
    	
	const datatables = document.querySelectorAll('.datatable')
	datatables.forEach(datatable => {
		new simpleDatatables.DataTable(datatable, {
			fixedHeight: true,
			searchable: true,
	    columns: [
	    // Sort the second column in ascending order
		    { select: 0, sort: "desc" },
		    { select: [0,1,3], sortable: false }

	    // Set the third column as datetime string matching the format "DD/MM/YYY"
	    // { select: 2, type: "date", format: "DD/MM/YYYY" }
	    ],   	    
	    labels: {
		    placeholder: "Buscar...",
		    perPage: "Elementos por página",
		    noRows: "No hay datos para mostrar",
		    info: "Mostrando {start} - {end} de {rows}"	
			}
		})


	const allBtnClose = document.querySelectorAll('.btn_close')
	allBtnClose.forEach( btn => {
		btn.addEventListener('click', () => {
			let active_modal = document.querySelector('.active-modal')
			active_modal.classList.toggle('active-modal')
			active_modal.classList.toggle('hidden')
		})
	})

	const allBtnEdit = document.querySelectorAll('.btn_reserva')
	allBtnEdit?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.currentTarget.getAttribute('data-item-edit')
			let modalEdit = document.querySelector('#modal_edit_reserva_'+id)
			modalEdit.classList.toggle('hidden')
			modalEdit.classList.toggle('active-modal')

			initForm(id)

		})
	})



	})


}) // end DOMcontentLoaded


window.addEventListener('click', (e) => {
  let activeModal = document.querySelector('.active-modal')
  if (e.target == activeModal) {
    activeModal.classList.toggle('active-modal')
    activeModal.classList.toggle('hidden')
  }
})


const initForm = (id) => {
	let status = document.querySelector('#status_'+id)
	let motivo = document.querySelector('#motivo_'+id)

	status.addEventListener('change', (e) => {
		let motivoSelect = document.querySelector('#motivo_'+id)

		if(e.target.value == 'cancelado') {
			motivoSelect.classList.remove('hidden')
		} else {
			if (!motivoSelect.classList.contains('hidden')) {
				motivoSelect.classList.add('hidden')
			}
		}
	})
}
// const statusSelect = document.querySelector('#status')
// // console.log(statusSelect)
// statusSelect.addEventListener('change', (e) => {
// 	console.log(e.target.value)
// 	if(e.target.value == 'cancelado') {
// 		let motivoSelect = document.querySelector('#motivo')
// 		motivoSelect.classList.toggle('hidden')
// 	}
// })

</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>

