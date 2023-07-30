<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full  flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  p-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex flex-col space-y-4 w-full md:w-3/4 font-dmsans">
			<!-- lista de horarios registrados -->

			<?php if(!empty($data['horarios'])) : ?>
			<div class="w-full p-4 bg-white flex flex-col rounded-xl ">
				<!-- Tabla Datatable -->
				<div class="w-full py-4 text-2xl text-neutral text-center">Horarios Registrados</div>

				<div class="w-full  bg-primary rounded-lg ">
					<table id="datatable" class="bg-white" >
	          <thead>
	            <tr>
	              <th>Dia</th>
	              <th>Hora Apertura</th>
	              <th>Hora Cierre</th>
	              <th>Opciones</th>
	            </tr>
	          </thead>
	          
	          <tbody >
	            <?php foreach($data['horarios'] as $row): ?>
	             <tr>
	                <td><?php echo $row->dia; ?> </td>
	                <td><?php echo $row->hora_inicio; ?> </td>
	                <td><?php echo $row->hora_fin; ?> </td>

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
			<?php endif; ?>


			<!-- form agregar horarios -->
			<div class="w-full p-4 bg-white flex flex-col rounded-xl ">
				<form action="<?php echo URLROOT . '/' . $data['controller'] . '/edit_turnos'; ?>" method="post" autocomplete="off" >

					<div class="w-full py-4 text-2xl text-neutral text-center">Selecciona uno o varios dias</div>

	        <div id="calendar">
	          <div class="month">
	            <ul>
	              <li id="prev" class="cursor-pointer"><i class="fas fa-chevron-left"></i></li>
	              <li id="month"></li>
	              <li id="year"></li>
	              <li id="next" class="cursor-pointer"><i class="fas fa-chevron-right"></i></li>
	            </ul>
	          </div>

	          <ul id="weekdays">
	            <li>Lun</li>
	            <li>Mar</li>
	            <li>Mie</li>
	            <li>Jue</li>
	            <li>Vie</li>
	            <li>Sab</li>
	            <li>Dom</li>
	          </ul>

	          <ul id="days"></ul>
	        </div>

	        <!-- container input dia[] -->
	      	<div id="dia-container"></div>

					<div class="w-full py-4 text-2xl text-neutral text-center">Selecciona Horario</div>

					<div class="flex flex-col items-center p-2">
					  <p class="text-red "> * Debes seleccionar al menos 1 día antes de guardar tus Horarios. </p>
					</div>

					<div class="flex justify-around mx-auto w-full p-4 ">

						<div class="flex flex-col space-y-4 w-max">
							<label for="dur_turno">Duracion Turno</label>
							<input type="number" id="dur_turno" min="1" step="1" name="dur_turno" class="p-2 rounded-xl text-lg outline-none bg-primary" required>

						</div>

						<div class="flex flex-col space-y-4 w-max">
							<label for="hora_inicio">Hora de Apertura</label>
							<select id="hora_inicio" name="hora_inicio" class="p-2 rounded-xl text-lg outline-none bg-primary" required>
                <option value="" selected>Seleccionar Hora</option>
                <?php if(isset($data['horas'])) : ?>
                  <?php foreach ($data['horas'] as $row) : ?>
                    <option value="<?php echo $row->hora ?>"><?php echo $row->hora ?></option>
                  <?php endforeach; ?>
                <?php endif; ?> 
              </select>
						</div>

						<div class="flex flex-col space-y-4 w-max">
							<label for="hora_fin">Hora de Cierre</label>
							<select id="hora_fin" name="hora_fin" class="p-2 rounded-xl text-lg outline-none bg-primary" required>
                <option value="" selected>Seleccionar Hora</option>
                <?php if(isset($data['horas'])) : ?>
                  <?php foreach ($data['horas'] as $row) : ?>
                    <option value="<?php echo $row->hora ?>"><?php echo $row->hora ?></option>
                  <?php endforeach; ?>
                <?php endif; ?> 
              </select>
						</div>
						
					</div>

		      <div class="flex items-center justify-center py-4">
			      <button type="submit" name="create_horario" class=" p-3 w-1/2 text-xl rounded-md font-bold text-dark bg-cta hover:bg-ctaDark">Guardar Horario</button>
			    </div>

				</form>
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

	  const initBtnEdit = (e) => {
			let id = e.currentTarget.getAttribute('data-item-edit')
			let modalEdit = document.querySelector('#modal_edit_'+id)
			modalEdit.classList.toggle('hidden')
			modalEdit.classList.toggle('active-modal')
		}

		const initBtnDelete = (e) => {
			let id = e.currentTarget.getAttribute('data-item-delete')
			let modalDelete = document.querySelector('#modal_delete_'+id)
			modalDelete.classList.toggle('hidden')
			modalDelete.classList.toggle('active-modal')
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

		let tabla_turnos = new simpleDatatables.DataTable(datatable, tableOptions)


		tabla_turnos.on('datatable.init', () => {

			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnEdit = document.querySelectorAll('.btn_edit')
			allBtnEdit?.forEach( btn => {
				btn.addEventListener('click', initBtnEdit)
			})

			const allBtnDelete = document.querySelectorAll('.btn_delete')
			allBtnDelete?.forEach( btn => {
				btn.addEventListener('click', initBtnDelete)
			})

		})



		// activar botones reserva y close al pasar a pagina 2
		tabla_turnos.on('datatable.page', page => {

			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.removeEventListener('click', initBtnClose)
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnEdit = document.querySelectorAll('.btn_edit')
			allBtnEdit?.forEach( btn => {
				btn.removeEventListener('click', initBtnEdit)
				btn.addEventListener('click', initBtnEdit)
			})

			const allBtnDelete = document.querySelectorAll('.btn_delete')
			allBtnDelete?.forEach( btn => {
				btn.removeEventListener('click', initBtnDelete)
				btn.addEventListener('click', initBtnDelete)
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

	<script src="<?php echo URLROOT; ?>/js/_usuariop_calendar.js"></script>

<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; 