<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<nav class="hidden md:flex flex-col w-1/4  text-white rounded-xl p-4 text-white text-xl">
			<?php foreach($data['sidebar'] as $item) : ?>
				<li class="list-none  hover:border-white">
					
					<a class="py-3 px-6 flex justify-between items-center <?php echo  ($data['page'] ==  ltrim($item->menu_item_url, "/")	) ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . $item->menu_item_url ?>">
						 <span><?php echo $item->menu_item_text ?></span><i class="fas <?php echo $item->menu_item_icon ?>"></i>  
					</a>
				</li>
			<?php endforeach; ?>
		</nav>	

		<input type="hidden" id="url" data-controller="<?php echo $data['controller'] ?>" data-root="<?php echo URLROOT ?>" data-page="<?php echo $data['page'] ?>">

		<div class="flex w-full md:w-3/4 bg-neutral overflow-hidden font-dmsans">

			<div class="flex flex-col w-full  md:p-4  space-y-8  overflow-y-scroll no-scrollbar">


				<!-- sidebar para perfil Usuarios Profesionales -->
				<div class="flex flex-col w-full space-y-4">

					<div class="w-full flex justify-between ">
						<h1 class="text-dark text-2xl text-white font-bold">Lista Profesiones </h1>
						<button id="btn_add" class="w-44 bg-cta  cursor-pointer p-2 font-bold rounded-xl">
							<i class="fas fa-plus"></i>Agregar Profesion
						</button>
					</div>
					<!-- Tabla Datatable -->
					<div class="w-full bg-primary rounded-lg ">
						<table class="bg-white datatable " >
		          <thead>
		            <tr>
		              <th>Id</th>
		              <th>Profesion</th>
		              <th>Estado</th>
		              <th>Opciones</th>
		            </tr>
		          </thead>
		          
		          <tbody >
		            <?php foreach($data['profesiones'] as $row): ?>
		            		
			             <tr>
			             		<td><?php echo $row->id; ?></td>
			                <td><?php echo $row->profesion; ?> </td>
			                <td> <?php setStatus($row->estado); ?></td>

			                <td>
			                	<div class="w-max flex space-x-8 ">

			             		    <button data-item-edit="<?php echo $row->id ?>"  class="btn_edit hover:text-green text-2xl"><i class="fas fa-edit"></i></button>
			                		<button data-item-delete="<?php echo $row->id ?>" class="btn_delete hover:text-red text-2xl"><i class="fas fa-trash"></i>	</button>   		
			                	</div>
			                	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_delete.php'; ?>
			                	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_edit.php'; ?>

			                </td>
			             </tr>
	
		            <?php endforeach; ?>            
		          </tbody>
		      	</table>
					</div>
				</div>

			</div>
		</div>



	</div>
</div>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_add.php'; ?>





	<script>
		
window.addEventListener('DOMContentLoaded', ()=> {

	const datatables = document.querySelectorAll('.datatable')
	datatables.forEach(datatable => {
		new simpleDatatables.DataTable(datatable, {
			searchable: true,
			fixedHeight: true,
	    columns: [
		    { select: 0, sort: "asc" },
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
<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>