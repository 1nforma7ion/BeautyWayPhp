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
			

			<div class="flex flex-col w-2/3  md:p-4  space-y-8">
				<div class="w-full flex justify-between ">
					<h1 class="text-dark text-2xl text-white ">Mi Perfil </h1>
				</div>

				<div class="group-row">
			    <div class="group-col">
			    	<label for="tipo_documento">Tipo de documento:</label>
				    <input type="text" id="tipo_documento" name="tipo_documento" required value="<?php echo $_SESSION['user_id'] ?>">
			    </div>

			    <div class="group-col relative">
			    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="num_documento">Numero Documento: 
				    	<span id="alert-doc" class="hidden italic text-sm text-red">Maximo <span id="chars_text">2</span> caracteres</span>
				    </label>
				    <input type="text" id="num_documento" name="num_documento"  minlength="3"  required placeholder="46801360">
			    </div>
			  </div>


			</div>


			<div class="flex flex-col w-1/3  md:p-4  space-y-4">
				<div class="w-full flex justify-between ">
					<h1 class="text-dark text-2xl text-white "> Profesion(es) </h1>
				</div>

		      <?php if(isset($data['profesiones'])) : ?>
            <?php foreach ($data['profesiones'] as $row) : ?>
							<div class="w-full flex items-center justify-between bg-primary p-2">
								<div class="space-x-2">
									<i class="fas fa-chevron-right mr-2"></i>
									<span><?php echo $row->profesion ?></span>
								</div>

								<a href="<?php echo URLROOT . '/' . $data['controller'] . '/edit_profesion/' . $row->id_profesion ?>" class="cursor-pointer p-1 text-2xl hover:bg-cta ">
									<i class="fas fa-edit"></i>
								</a>
							</div>
            <?php endforeach; ?>
          <?php endif; ?> 



						

				
				
				<button id="btn_add" class="w-44 bg-cta  cursor-pointer p-2 font-bold rounded-xl">
					<i class="fas fa-plus mr-2"></i>Agregar Profesion
				</button>

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
	const allBtnClose = document.querySelectorAll('.btn_close')
  allBtnClose.forEach( btn => {
    btn.addEventListener('click', () => {
      let active_modal = document.querySelector('.active-modal')
      active_modal.classList.toggle('active-modal')
      active_modal.classList.toggle('hidden')
    })
  })

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