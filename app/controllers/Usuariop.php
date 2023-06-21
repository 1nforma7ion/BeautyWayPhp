<?php 
	class Usuariop extends Controller {
		public function __construct() {
			$this->usuariop = $this->model('Userp');
			$this->admin = $this->model('Administrador');

		}

		public function index() {
			if (usuariopLoggedIn()) {

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/index',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function perfil() {
			if (usuariopLoggedIn()) {

					if (isset($_POST['add_profesion'])) {
						
						$id_profesion = $_POST['profesion'];

						$added = $this->usuariop->agregarProfesion($_SESSION['user_id'], $id_profesion);
						
						if ($added) {
							redirect('usuariop/perfil');
						}

					}

				$listaProfesiones = $this->admin->getProfesiones();
				$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'profesiones' => $profesiones,
					'listaProfesiones' => $listaProfesiones,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/perfil',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function edit_profesion($id_profesion = null) {
			if (usuariopLoggedIn()) {
				if(is_null($id_profesion)) {
					redirect('usuariop/index');

				} else {

					if (isset($_POST['activar_servicio'])) {
						
						$servicio = $_POST['servicio'];

						$added = $this->usuariop->activarServicio($_SESSION['user_id'], $id_profesion, $servicio);
						
						if ($added) {
							redirect('usuariop/edit_profesion/' . $id_profesion);
						}

					}

					if (isset($_POST['desactivar_servicio'])) {
						
						$id_servicio = $_POST['id_servicio'];

						$deleted = $this->usuariop->desactivarServicio($id_servicio);
						
						if ($deleted) {
							redirect('usuariop/edit_profesion/' . $id_profesion);
						}

					}

					$profesion = $this->usuariop->getProfesionById($id_profesion);
					$listaServicios = $this->usuariop->getServiciosByUser($_SESSION['user_id'], $id_profesion);
					$todosServicios = $this->usuariop->getTodosServiciosById($id_profesion);

					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

					$data = [
						'profesion' => $profesion,
						'todosServicios' => $todosServicios,
						'listaServicios' => $listaServicios,
						'sidebar' => $sidebar,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('usuariop/edit_profesion',$data);


				}

			} else {
				redirect('pages/login');
			}
		}


		public function reservas() {
			if (usuariopLoggedIn()) {

				$reservas = $this->usuariop->getReservasByUser($_SESSION['user_id']);
				$data = [
					'reservas' => $reservas,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/reservas',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function publicar() {
			if (usuariopLoggedIn()) {
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {

					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					$user_id = $_POST['user_id'];
					$descripcion = $_POST['descripcion'];
					$estado = DEFAULT_USER_STATUS;
					$descuento = $_POST['descuento'];
					$vigencia = $_POST['vigencia'];
					$zona = $_POST['zona'];
					$servicio = $_POST['servicio'];


					// echo "<pre>";
					// print_r($_POST);
					// die();
					$imagen = $_FILES['imagen']['name'];


				  	if ($imagen) {

				  		$archivo = $_FILES['imagen'];
	
							$year = date('Y');
							$month = date('m');

			      	if(file_exists('../public/files/' . $year . '/' . $month)) {
								$filesDir = '../public/files/' . $year . '/' . $month . '/';
			      	} else {
			    			mkdir('../public/files/' . $year);
			    			mkdir('../public/files/' . $year . '/' . $month);
								$filesDir = '../public/files/' . $year . '/' . $month . '/';
			      	}

	
		        	$i_name = $archivo['name'];
							$i_tmp = $archivo['tmp_name'];

							move_uploaded_file($i_tmp, $filesDir . $i_name);

							$urlImagen = '/files/' . $year . '/' . $month . '/' . $i_name;

			        $saved = $this->usuariop->savePublic($user_id, $descripcion, $urlImagen, $zona, $estado, $descuento, $vigencia);

			        if ($saved) {
					      $_SESSION['msg'] = 'saved';
								redirect('usuariop/index');
							} else {
								die('ocurrio un error');
							}

			      }



				} else {
					
					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
					$servicios = $this->usuariop->getServiciosByUser($_SESSION['user_id_profesion']);

					$zonas = $this->usuariop->getZonas();
					$data = [

						'servicios' => $servicios,
						'sidebar' => $sidebar,
						'zonas' => $zonas,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('usuariop/publicar', $data);
				}

			} else {
				redirect('pages/login');
			}
		}



		public function registrar() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


					$tipo = $_POST['tipo_documento'];
					$doc = $_POST['num_documento'];
					$nombre = $_POST['nombre'];
					$apellido = $_POST['apellido'];
					$calle = $_POST['calle'];
					$altura = $_POST['altura'];
					$piso = $_POST['piso'];
					$depto = $_POST['depto'];
					$barrio = $_POST['barrio'];
					$localidad = $_POST['localidad'];
					$telefono = $_POST['telefono'];
					$email = $_POST['email'];
					$pass = $_POST['contrasenia'];
					$rep_pass = $_POST['repetirContrasenia'];
					$comercial = $_POST['nombre_comercial'];
					$profesion = $_POST['profesion'];
					$modalidad = $_POST['modalidad'];
					$zona = $_POST['zona'];

					if(!empty($_POST['nombre_comercial'])) {
						$rol = ID_USER_PRO;
					} else {
						$rol = ID_USER_NORMAL;
					}

					if ($pass !== $rep_pass) {
						$_SESSION['msg'] = 'Contraseñas no coinciden.';
						redirect('pages/registrar');
					}

					// echo "<pre>";
					// print_r($_POST);
					// die();
		
					$userExists = $this->page->findEmail($email);

					if ($userExists) {
						$_SESSION['msg'] = 'El email ya se encuentra registrado.';
						redirect('pages/registrar');
					} else {
						$pass = password_hash($pass, PASSWORD_DEFAULT);

						$this->page->register($rol,$tipo,$doc,$nombre,$apellido,$calle,$altura,$piso,$depto,$barrio,$localidad,$telefono,$email,$pass,$comercial,$profesion,$modalidad,$zona);

						$_SESSION['msg'] = 'Registrado Correctamente.';
						redirect('pages/login');
					}

				} else {
					$profesiones = $this->page->getProfesiones();
					$controller = strtolower(get_called_class());
					$data = [
						'profesiones' => $profesiones,
						'controller' => $controller,
						'page' => __FUNCTION__
					];
					$this->view('pages/registrar', $data);
				}

		}


		
	}
?>