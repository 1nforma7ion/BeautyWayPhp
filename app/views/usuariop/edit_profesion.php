<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full md:w-3/4 bg-neutral  font-dmsans overflow-hidden">
			

			<div class="flex flex-col w-1/2  md:p-4  space-y-2">

				<div class="w-full flex justify-between ">
					<h1 class="text-dark text-2xl text-white "> Servicios para <?php echo $data['profesion']->profesion ?> </h1>
				</div>
         
        <div class=" w-full bg-primary rounded-lg ">
	        <table id="datatable" class="bg-white " >
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

		let tabla_servicios = new simpleDatatables.DataTable(datatable, tableOptions)


		tabla_servicios.on('datatable.init', () => {
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose?.forEach( btn => {
				btn.addEventListener('click', initBtnClose)
			})

		})


	})  // end DOMContentLoaded
</script>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 