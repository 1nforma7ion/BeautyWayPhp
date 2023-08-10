<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full flex flex-col md:flex-row md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="w-full md:w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex flex-col p-4 space-y-4 w-full md:w-3/4 font-dmsans">

			<div class="w-full p-4 h-screen  bg-white flex flex-col rounded-xl ">
				<!-- Tabla Datatable -->
				<div class="w-full flex justify-between py-4 text-2xl text-neutral text-center">
					<h2 class="text-4xl">Mensajes Recibidos</h2>  
					<div class="w-1/3">
						<?php showMsg(); ?>
					</div> 
          
				</div>

				<div class="w-full  bg-primary rounded-lg ">
					<table id="datatable" class="bg-white " >
	          <thead>
	            <tr>
	              <th>Enviado Por</th>
	              <th>Mensaje</th>
	              <th>Fecha</th>
	              <th>Resp.</th>
	            </tr>
	          </thead>
	          
	          <tbody >
							<?php if(!empty($data['mensajes'])) : ?>

	            <?php foreach($data['mensajes'] as $row): ?>
	             <tr>
	                <td><div class="w-64"><?php echo $row->nombre . ' ' . $row->apellido; ?></div> </td>
	                <td> <div class="w-full"> <?php echo $row->mensaje; ?></div> </td>
	                <td><div class="w-max"><?php echo fixedFecha($row->fecha); ?> </div></td>
	                <td>
	                	<div class="w-max flex space-x-8 ">
	             		    <button data-item-edit="<?php echo $row->mensaje_id ?>"  class="btn_responder p-1 rounded text-lg bg-neutral text-white ">
	             		    	<i class="fas fa-reply "></i>
	             		    </button>
	                		 		
	                	</div>
	                	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_responder.php'; ?>
	                	
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
	    	
	  const initBtnClose = () => {
			let active_modal = document.querySelector('.active-modal')
			active_modal.classList.toggle('active-modal')
			active_modal.classList.toggle('hidden')		
	  }

	  const initBtnResponder = (e) => {
			let id = e.target.parentElement.getAttribute('data-item-edit')
			let modalEdit = document.querySelector('#modal_responder_'+id)
			modalEdit.classList.toggle('hidden')
			modalEdit.classList.toggle('active-modal')
		}


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

		let tabla_reservas = new simpleDatatables.DataTable(datatable, tableOptions)


		tabla_reservas.on('datatable.init', () => {
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnResponder = document.querySelectorAll('.btn_responder')
			allBtnResponder?.forEach( btn => {
				btn.addEventListener('click', initBtnResponder)
			})
		})


		// activar botones reserva y close al pasar a pagina 2
		tabla_reservas.on('datatable.page', page => {
			// console.log(page)
					const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.removeEventListener('click', initBtnClose)
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnResponder = document.querySelectorAll('.btn_responder')
			allBtnResponder?.forEach( btn => {
				btn.removeEventListener('click', initBtnResponder)
				btn.addEventListener('click', initBtnResponder)
			})	
		})

		// activar botones reserva y close al usar dropdown " elementos por pagina"
		tabla_reservas.on('datatable.perpage', perpage => {
			// console.log(perpage)
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.removeEventListener('click', initBtnClose)
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnResponder = document.querySelectorAll('.btn_responder')
			allBtnResponder?.forEach( btn => {
				btn.removeEventListener('click', initBtnResponder)
				btn.addEventListener('click', initBtnResponder)
			})
			
		})

		// activar botones close al usar el Buscador
		tabla_reservas.on('datatable.search', (query, matched)  => {
			// console.log(perpage)
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.removeEventListener('click', initBtnClose)
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnResponder = document.querySelectorAll('.btn_responder')
			allBtnResponder?.forEach( btn => {
				btn.removeEventListener('click', initBtnResponder)
				btn.addEventListener('click', initBtnResponder)
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