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
			

			<div class="flex flex-col w-1/2  md:p-4  space-y-2">

				<div class="w-full flex justify-between ">
					<h1 class="text-dark text-2xl text-white "> Servicios para <?php echo $data['profesion']->profesion ?> </h1>
				</div>
         
        <div class=" w-full bg-primary rounded-lg ">
	        <table class="bg-white datatable " >
	          <thead>
	            <tr>
	              <th>Servicio</th>
	              <th>Acción</th>
	            </tr>
	          </thead>
	          
	          <tbody>      
	          	<?php if(isset($data['todosServicios'])) : ?>
	          	<?php foreach($data['todosServicios'] as $row) : ?>
	              <tr>
	                <td><?php echo $row->servicio; ?> </td>
	                <td> 
		                <form action="<?php echo URLROOT; ?>/usuariop/edit_profesion/<?php echo $data['profesion']->id ?>" method="post" autocomplete="off" >
											<input type="hidden" name="servicio" value="<?php echo $row->servicio ?>" >
											<button name="activar_servicio" class=" bg-neutral px-2 rounded-full text-white text-xl"><i class="fas fa-plus"></i> Activar</button>  
										</form>
	                </td>
	              </tr>
	            <?php endforeach; ?>   
	          <?php endif; ?>

	          </tbody>
	        </table>
				</div>

			</div>


			<div class="flex flex-col w-1/2  md:p-4  space-y-2">
				<div class="w-full flex justify-between ">
					<h1 class="text-dark text-2xl text-white "> Mis servicios Activos </h1>
				</div>

		      <?php if(isset($data['listaServicios'])) : ?>
            <?php foreach ($data['listaServicios'] as $row) : ?>
	            <form action="<?php echo URLROOT; ?>/usuariop/edit_profesion/<?php echo $data['profesion']->id ?>" method="post" autocomplete="off" >
								<input type="hidden" name="id_servicio" value="<?php echo $row->id ?>" >

								<div class="w-3/4 flex items-center justify-between bg-primary p-2">
									<div class="space-x-2">
										<i class="fas fa-check mr-2"></i>
										<span><?php echo $row->servicio ?></span>
									</div>

									<button name="desactivar_servicio" class=" hover:text-red text-2xl"><i class="fas fa-trash"></i></button>  
								</div>

							</form>
            <?php endforeach; ?>
          <?php endif; ?> 

			</div>


		
		</div>

	</div>
</div>

<?php 

echo "<pre>";
print_r($data);
echo "</pre>";
 ?>

	<script>
		
window.addEventListener('DOMContentLoaded', ()=> {

	const datatables = document.querySelectorAll('.datatable')
	datatables.forEach(datatable => {
		new simpleDatatables.DataTable(datatable, {
			searchable: true,
			fixedHeight: true,
	    columns: [
	    // Sort the second column in ascending order
		    { select: 0, sort: "asc" },


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
			console.log(active_modal)
		})
	})

	const allBtnEdit = document.querySelectorAll('.btn_edit')
	allBtnEdit?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.target.parentElement.getAttribute('data-item-edit')
			let modalEdit = document.querySelector('#modal_edit_'+id)
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

// end DOMContentLoaded

const modal_Add = document.querySelector('#modal_add')

const btn_Add = document.querySelector('#btn_add')
btn_Add?.addEventListener('click', () => {
	modal_Add.classList.toggle('hidden')
	modal_Add.classList.toggle('active-modal')
	console.log(modal_Add)
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