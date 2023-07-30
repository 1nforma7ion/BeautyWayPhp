<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full flex flex-col md:flex-row md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="w-full md:w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex flex-col p-4 space-y-4 w-full md:w-3/4 font-dmsans">

			<div class="w-full p-4 bg-white flex flex-col rounded-xl ">
				<!-- Tabla Datatable -->
				<div class="w-full flex justify-between py-4 text-2xl text-neutral text-center">
					<h2 class="text-4xl">Mis Publicaciones </h2>  
					<div class="w-1/3">
						<?php showMsg(); ?>
					</div> 
				</div>

				<div class="w-full  bg-primary rounded-lg ">
					<table id="datatable" class="bg-white " >
	          <thead>
	            <tr>
	              <th>Servicio</th>
	              <th>Zona</th>
	              <th>Descuento</th>
	              <th>Me gusta</th>
	              <th>Comentarios</th>
	              <th>Fecha</th>
	              <th>Estado</th>
	              <th>Opc.</th>
	            </tr>
	          </thead>
	          
	          <tbody >
							<?php if(!empty($data['publicaciones'])) : ?>

	            <?php foreach($data['publicaciones'] as $row): ?>
	             <tr>
	                <td><div class="w-max"><?php echo $row->servicio; ?></div> </td>
	                <td> <div class="w-max"> <?php echo $row->zona_public; ?></div> </td>
	                <td> <div class="w-max"> <?php echo $row->descuento; ?></div> </td>
	                <td> <div class="w-max"> <?php echo $row->me_gusta; ?></div> </td>
	                <td> <div class="w-max"> <?php echo $row->comentarios; ?></div> </td>
	                <td> <div class="w-max"> <?php echo fixedFecha($row->creado); ?></div> </td>
	                <td><div class="w-max"><?php echo setStatus($row->estado); ?> </div></td>
	                <td>
	                	<div class="w-max flex space-x-8 ">
	             		    <button data-item-edit="<?php echo $row->id_public ?>"  class="btn_editar ">
	             		    	<i class="fas fa-trash text-xl text-red"></i>
	             		    </button>
	                		 		
	                	</div>
	                	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_reserva.php'; ?>
	                	
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

// echo "<pre>";
// print_r($data);
// echo "</pre>";
 ?>




<script>

	window.addEventListener('DOMContentLoaded', ()=> {

	 	const successAlert = document.querySelector('#success_msg')
	  	setTimeout(() => {
	    	successAlert?.remove()
	  	}, 5000)

		const datatable = document.querySelector('#datatable')

		let tableOptions = {
			searchable: true,
			fixedHeight: true,
	    labels: {
	    	searchTitle: "Buscar ...",
		    placeholder: "Buscar...",
		    perPage: "Elementos por página",
		    noRows: "No hay datos para mostrar",
		    info: "Mostrando {start} - {end} de {rows}"	
			}
			// perPage: 40
		}

		let tabla_publicaciones = new simpleDatatables.DataTable(datatable, tableOptions)


		tabla_publicaciones.on('datatable.init', () => {
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.addEventListener('click', () => {
					let active_modal = document.querySelector('.active-modal')
					active_modal.classList.toggle('active-modal')
					active_modal.classList.toggle('hidden')
				})
			})


			const allBtnEditar = document.querySelectorAll(".btn_editar")
			allBtnEditar?.forEach( btn => {
				btn.addEventListener('click', (e) => {
					let id = e.currentTarget.getAttribute('data-item-edit')
					let modalRes = document.querySelector('#modal_reserva_'+id)
					modalRes.classList.toggle('hidden')
					modalRes.classList.toggle('active-modal')

				})
			})
		})



		// activar botones reserva y close al pasar a pagina 2
		tabla_publicaciones.on('datatable.page', page => {
			// console.log(page)
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.addEventListener('click', () => {
					let active_modal = document.querySelector('.active-modal')
					active_modal.classList.toggle('active-modal')
					active_modal.classList.toggle('hidden')
				})
			})

			const allBtnEditar = document.querySelectorAll(".btn_editar")
			allBtnEditar?.forEach( btn => {
				btn.addEventListener('click', (e) => {
					let id = e.currentTarget.getAttribute('data-item-edit')
					let modalRes = document.querySelector('#modal_reserva_'+id)
					modalRes.classList.toggle('hidden')
					modalRes.classList.toggle('active-modal')

				})
			})
		})

		// activar botones reserva y close al usar dropdown " elementos por pagina"
		tabla_publicaciones.on('datatable.perpage', perpage => {
			// console.log(perpage)
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.addEventListener('click', () => {
					let active_modal = document.querySelector('.active-modal')
					active_modal.classList.toggle('active-modal')
					active_modal.classList.toggle('hidden')
				})
			})
		}) 

		tabla_publicaciones.on('datatable.search', perpage => {
			// console.log(perpage)
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.addEventListener('click', () => {
					let active_modal = document.querySelector('.active-modal')
					active_modal.classList.toggle('active-modal')
					active_modal.classList.toggle('hidden')
				})
			})
		})

	})  // end DOMcontentLoaded



window.addEventListener('click', (e) => {
  let activeModal = document.querySelector('.active-modal')
  if (e.target == activeModal) {
    activeModal.classList.toggle('active-modal')
    activeModal.classList.toggle('hidden')
  }
})



</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 