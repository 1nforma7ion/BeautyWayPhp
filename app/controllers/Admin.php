<?php 

	class Admin extends Controller {
		
		public function __construct() {
			$this->admin = $this->model('Administrador');
		}

		public function condiciones() {
			if (adminLoggedIn()) {

					if (isset($_POST['create_condicion'])) {

						$numero = $_POST['numero'];
						$titulo = $_POST['titulo'];
						$descripcion = $_POST['descripcion'];
						$estado = $_POST['estado'];

						$added = $this->admin->createCondicion($numero, $titulo, $descripcion, $estado);
						
						if ($added) {
							$_SESSION['success_msg'] = 'Agregado Correctamente';
							redirect('admin/condiciones');
					    exit();
						}

					}


					if (isset($_POST['update_condicion'])) {

						$condicion_id = $_POST['condicion_id'];
						$numero = $_POST['numero'];
						$titulo = $_POST['titulo'];
						$descripcion = $_POST['descripcion'];
						$estado = $_POST['estado'];

						$updated = $this->admin->updateCondicion($condicion_id, $numero, $titulo, $descripcion, $estado);
						
						if ($updated) {
							$_SESSION['success_msg'] = 'Actualizado Correctamente';
							redirect('admin/condiciones');
					    exit();
						}

					}


				$condiciones = $this->admin->readCondiciones();

				$menuSidebar = $this->admin->getMenuSidebar();
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'condiciones' => $condiciones,
					'sidebar' => $sidebar,
					'menuSidebar' => $menuSidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('admin/condiciones',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function reportes() {
			if (adminLoggedIn()) {

				$usuarios = $this->admin->readAllUsers();
				$modalidades = $this->admin->readReservasByModalidad('finalizado');
				$contratados = $this->admin->readServiciosContratados('finalizado', 10);
				$servicios_zona = $this->admin->readServiciosZona('finalizado');
				$likes_serv = $this->admin->readLikesServicios(10);

				$menuSidebar = $this->admin->getMenuSidebar();
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'modalidades' => $modalidades,
					'usuarios' => $usuarios,
					'contratados' => $contratados,
					'likes_serv' => $likes_serv,
					'servicios_zona' => $servicios_zona,
					'sidebar' => $sidebar,
					'menuSidebar' => $menuSidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('admin/reportes',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function servicios($id_profesion = null) {
			if (adminLoggedIn()) {
				if(is_null($id_profesion)) {
					$profesiones = $this->admin->getProfesiones();
					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

					$data = [
						'profesiones' => $profesiones,
						'sidebar' => $sidebar,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('admin/servicios',$data);

				} else {

					if (isset($_POST['add_servicio'])) {
						// $id_profesion = $_POST['id_profesion'];
						$servicio = $_POST['servicio'];
						$estado = $_POST['estado'];

						$added = $this->admin->addServicio($id_profesion, $servicio, $estado);
						
						if ($added) {
							redirect('admin/servicios/' . $id_profesion);
						}

					}

					if (isset($_POST['delete_profesion'])) {
						$id = $_POST['profesion_id'];
						$deleted = $this->admin->deleteProfesion($id);
						
						if ($deleted) {
							redirect('admin/profesiones');
						}

					}

					if (isset($_POST['edit_servicio'])) {
						$servicio_id = $_POST['servicio_id'];
						$servicio = $_POST['servicio'];
						$estado = $_POST['estado'];

						$updated = $this->admin->updateServicio($servicio_id, $servicio, $estado);
						
						if ($updated) {
							redirect('admin/servicios/' . $id_profesion);
						}

					}

					$profesiones = $this->admin->getProfesiones();
					$servicios = $this->admin->getServiciosByProfesion($id_profesion);
					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

					$data = [
						'id_profesion' => $id_profesion,
						'profesiones' => $profesiones,
						'servicios' => $servicios,
						'sidebar' => $sidebar,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('admin/servicios',$data);


				}


			} else {
				redirect('pages/login');
			}
		}


		public function profesiones() {
			if (adminLoggedIn()) {

				if (isset($_POST['add_profesion'])) {
					$profesion = $_POST['profesion'];
					$estado = $_POST['estado'];

					$added = $this->admin->addProfesion($profesion, $estado);
					
					if ($added) {
						redirect('admin/profesiones');
					}

				}

				if (isset($_POST['delete_profesion'])) {
					$id = $_POST['profesion_id'];
					$deleted = $this->admin->deleteProfesion($id);
					
					if ($deleted) {
						redirect('admin/profesiones');
					}

				}

				if (isset($_POST['edit_profesion'])) {

					$profesion_id = $_POST['profesion_id'];
					$profesion = $_POST['profesion'];
					$estado = $_POST['estado'];


					$updated = $this->admin->updateProfesion($profesion_id,$profesion,$estado);
					
					if ($updated) {
						redirect('admin/profesiones');
					}

				}

				$profesiones = $this->admin->getProfesiones();
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'profesiones' => $profesiones,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('admin/profesiones',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function sidebar() {
			if (adminLoggedIn()) {

				if (isset($_POST['delete_menu_item'])) {
					$id = $_POST['item_id_delete'];
					$deleted = $this->admin->deleteMenuItem($id);
					
					if ($deleted) {
						redirect('admin/sidebar');
					}

				}

				if (isset($_POST['edit_menu_item'])) {

					$item_id = $_POST['item_id'];
					$rol_id = $_POST['user_rol_id'];
					$url = $_POST['menu_item_url'];
					$text = $_POST['menu_item_text'];
					$icon = $_POST['menu_item_icon'];
					$status = $_POST['menu_item_status'];
					$order = $_POST['menu_item_order'];

					$updated = $this->admin->updateMenuItem($item_id,$rol_id,$url,$text,$icon,$status,$order);
					
					if ($updated) {
						redirect('admin/sidebar');
					}

				}


				if (isset($_POST['add_menu_item'])) {
					$rol_id = $_POST['user_rol_id'];
					$url = $_POST['menu_item_url'];
					$text = $_POST['menu_item_text'];
					$icon = $_POST['menu_item_icon'];
					$status = $_POST['menu_item_status'];
					$order = $_POST['menu_item_order'];
					
					$added = $this->admin->addMenuItem($rol_id,$url,$text,$icon,$status,$order);
					
					if ($added) {
						redirect('admin/sidebar');
					}

				}

				$roles = $this->admin->getRoles();
				$menuSidebar = $this->admin->getMenuSidebar();
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'sidebar' => $sidebar,
					'roles' => $roles,
					'menuSidebar' => $menuSidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('admin/sidebar',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function usuarios() {
			if (adminLoggedIn()) {

				if (isset($_POST['delete_usuario'])) {
					$id = $_POST['usuario_id'];
					$deleted = $this->admin->deleteUsuario($id);
					// echo "<pre>";
					// print_r($_POST);
					// die();

					if ($deleted) {
						redirect('admin/usuarios');
					}

				}

				if (isset($_POST['edit_usuario'])) {
					$user_id = $_POST['user_id'];
					$rol_id = $_POST['rol_id'];
					$telefono = $_POST['telefono'];
					$nombre = $_POST['nombre'];
					$apellido = $_POST['apellido'];
					$email = $_POST['email'];
					$estado = $_POST['estado'];
					

					$updated = $this->admin->updateUsuario($user_id,$rol_id,$telefono,$nombre,$apellido,$email,$estado);
					
					if ($updated) {
						redirect('admin/usuarios');
					}
				}

				$roles = $this->admin->getRoles();
				$usuarios = $this->admin->getUsuarios();
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'sidebar' => $sidebar,
					'roles' => $roles,
					'usuarios' => $usuarios,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('admin/usuarios',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function profesionales() {
			if (adminLoggedIn()) {

				if (isset($_POST['delete_usuario'])) {
					$id = $_POST['usuario_id'];
					$deleted = $this->admin->deleteUsuario($id);
					
					if ($deleted) {
						redirect('admin/profesionales');
					}
				}

				if (isset($_POST['edit_usuario'])) {

					$user_id = $_POST['user_id'];
					$rol_id = $_POST['rol_id'];
					$nombre_comercial = $_POST['nombre_comercial'];
					$nombre = $_POST['nombre'];
					$apellido = $_POST['apellido'];
					$email = $_POST['email'];
					$estado = $_POST['estado'];

					$updated = $this->admin->updateProfesional($user_id,$rol_id,$nombre_comercial,$nombre,$apellido,$email,$estado);
					
					if ($updated) {
						redirect('admin/profesionales');
					}
				}

				$roles = $this->admin->getRoles();
				$usuarios = $this->admin->getUsuarios();
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'sidebar' => $sidebar,
					'roles' => $roles,
					'usuarios' => $usuarios,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('admin/profesionales',$data);

			} else {
				redirect('pages/login');
			}
		}



}
?>