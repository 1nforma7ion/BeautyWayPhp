<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full ">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full md:h-screen flex flex-col md:flex-row md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="w-full md:w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex flex-col p-4 space-y-4 w-full md:w-3/4 font-dmsans">


			<?php if(!empty($data['mensajes'])) : ?>
			<div class="w-full p-4 bg-white flex flex-col rounded-xl ">
				<!-- Tabla Datatable -->
				<div class="w-full flex justify-between py-4 text-2xl text-neutral text-center">
					<h2 class="text-4xl">Mensajes Recibidos</h2>  
					<div class="w-1/3">
						<?php echo $data['success'] ? 'MEnsaje enviado' : ''; ?>
					</div>
          
				</div>

				<div class="w-full  bg-primary rounded-lg ">
					<table class="bg-white datatable " >
	          <thead>
	            <tr>
	              <th>Enviado Por</th>
	              <th>Mensaje</th>
	              <th>Fecha</th>
	              <th>Opciones</th>
	            </tr>
	          </thead>
	          
	          <tbody >
	            <?php foreach($data['mensajes'] as $row): ?>
	             <tr>
	                <td><div class="w-64"><?php echo $row->nombre_comercial; ?></div> </td>
	                <td> <div class="w-full"> <?php echo $row->mensaje; ?></div> </td>
	                <td><div class="w-max"><?php echo $row->fecha; ?> </div></td>
	                <td>
	                	<div class="w-max flex space-x-8 ">
	             		    <button data-item-edit="<?php echo $row->mensaje_id ?>"  class="btn_responder text-white bg-neutral py-2 px-6 rounded text-xl ">
	             		    	<i class="fas fa-reply"></i>
	             		    </button>
	                		 		
	                	</div>
	                	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_responder.php'; ?>
	                	
	                </td>
	             </tr>

	            <?php endforeach; ?>            
	          </tbody>
	      	</table>
				</div>
			</div>
			<?php endif; ?>

		</div>

	</div>
</div>

<?php 

// echo "<pre>";
// print_r($data);
// echo "</pre>";
 ?>




	<script >

window.addEventListener('DOMContentLoaded', ()=> {

	const datatables = document.querySelectorAll('.datatable')
	datatables.forEach(datatable => {
		new simpleDatatables.DataTable(datatable, {

			searchable: true,
			// fixedHeight: true,
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

	const allBtnEdit = document.querySelectorAll('.btn_responder')
	allBtnEdit?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.target.parentElement.getAttribute('data-item-edit')
			let modalEdit = document.querySelector('#modal_responder_'+id)
			modalEdit.classList.toggle('hidden')
			modalEdit.classList.toggle('active-modal')

		})
	})

	const allBtnDelete = document.querySelectorAll('.btn_delete')
	allBtnDelete?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.target.parentElement.getAttribute('data-item-delete')
			let modalDelete = document.querySelector('#modal_delete_'+id)
			modalDelete.classList.toggle('hidden')
			modalDelete.classList.toggle('active-modal')

		})
	})


	})
})

// end DOMcontentLoaded

window.addEventListener('click', (e) => {
  let activeModal = document.querySelector('.active-modal')
  if (e.target == activeModal) {
    activeModal.classList.toggle('active-modal')
    activeModal.classList.toggle('hidden')
  }
})


</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 