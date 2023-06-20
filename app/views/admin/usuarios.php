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

				<!-- sidebar para perfil Usuarios -->
				<div class="flex flex-col w-full space-y-4">

					<div class="w-full flex justify-between ">
						<h1 class="text-dark text-2xl text-white font-bold">Lista Usuarios</h1>

					</div>
					<!-- Tabla Datatable -->
					<div class="w-full bg-primary rounded-lg ">
						<table class="bg-white datatable " >
		          <thead>
		            <tr>
		              <th>Id</th>
		              <th>Nombre</th>
		              <th>Teléfono</th>
		              <th>Email</th>
		              <th>Estado</th>
		              <th>Opciones</th>
		            </tr>
		          </thead>
		          
		          <tbody >
		            <?php foreach($data['usuarios'] as $row): ?>
		            	<?php if ($row->rol_id == 2) : ?>
		            		
			             <tr>
			             		<td><?php echo $row->user_id; ?></td>
			             		<td><?php echo $row->nombre . ' ' . $row->apellido; ?></td>
			                <td><?php echo $row->telefono; ?>   </td>
			                <td><?php echo $row->email; ?> </td>
			                <td> <?php setStatus($row->estado); ?></td>

			                <td>
			                	<div class="w-max flex space-x-8 ">

			             		    <button data-item-edit="<?php echo $row->user_id ?>"  class="btn_edit hover:text-green text-2xl"><i class="fas fa-edit"></i></button>
			                		<button data-item-delete="<?php echo $row->user_id ?>" class="btn_delete hover:text-red text-2xl"><i class="fas fa-trash"></i>	</button>   		
			                	</div>
			                	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_delete.php'; ?>
			                	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_edit.php'; ?>

			                </td>
			             </tr>
			           <?php endif; ?>
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



<script src="<?php echo URLROOT; ?>/js/_admin_usuarios.js"></script>
<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>