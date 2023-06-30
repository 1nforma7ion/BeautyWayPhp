<?php 
	class Usuariop extends Controller {
		public function __construct() {
			$this->usuariop = $this->model('Userp');
			$this->admin = $this->model('Administrador');
			$this->page = $this->model('Page');

		}

		public function index() {
			if (usuariopLoggedIn()) {
				$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
				$publicaciones = $this->usuariop->getPublicacionesByUser($_SESSION['user_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
					'publicaciones' => $publicaciones,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/index',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function reservar() {
			if (usuariopLoggedIn()) {

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
				$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
				$turnos = $this->usuariop->getTurnosByUser($_SESSION['user_id']);

				$data = [
					'turnos' => $turnos,
					'horarios' => $horarios,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/reservar',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function edit_turnos() {
			if (usuariopLoggedIn()) {

				if (isset($_POST['create_horario'])) {
					$dia = $_POST['dia'];
					$dur_turno = $_POST['dur_turno'];

					$hora_inicio = $_POST['hora_inicio'];
					$hora_fin = $_POST['hora_fin'];

					$total_turnos = (intval($hora_fin) - intval($hora_inicio)) / ceil($dur_turno);


					$turnos = [];
					for( $k = 0; $k < $total_turnos; $k ++) {
						// crear hora fin, modificando hora inicio
						$hora_inicio = intval($hora_inicio) + $dur_turno;

						$turnos[$k] = [
							'hora_inicio' => ($hora_inicio - $dur_turno) . ':00',
							'hora_fin' => $hora_inicio . ':00',
						];
					}	

					$result=[];

					for($c = 0; $c < count($dia); $c++) {
						$result[$c] = setTurnos($turnos, $dia[$c]);
						// array_push($result[$c], $dia[$c]);
					}

					// $arr = [];
					// for($k = 0; $k < count($dia); $k ++) {
					// 	$arr[$k] = [
					// 		'user_id' => $_SESSION['user_id'],
					// 		'dia' => $dia[$k]
					// 	]; 
					// }

				// 	function setArr($tur, $dia) {
				// 	for($a = 0; $a < count($tur); $a++) {
				// 		$tur[$a]['dia'] = $arr[$a];
				// 		$tur[$a]['user_id'] = $_SESSION['user_id'];
				// 	}

				// 	return $tur;
				// }

					



					// $horarios = [];
				  // for($i = 0; $i < count($dia); $i++) {
				  //   $horarios[$i] = [
				  //   'user_id' => $_SESSION['user_id'],
				  //   'dia' => $dia[$i],
				  //   'hora_inicio' => $hora_inicio,
				  //   'hora_fin' => $hora_fin
				  //   ];
				  //   // array_push($data, $fila)
				  // }

				  // echo "<pre>";
				  // print_r($horarios);
				  // print_r($result);
				  // print_r($dia);

				  // print_r($turnos);
				  // print_r($dia);
				  // die();


					$added = $this->usuariop->agregarHorario($result);
					
					if ($added) {
						redirect('usuariop/edit_turnos');
					}
				}


				// if (isset($_POST['add_turno'])) {
				// 	$dia = $_POST['dia'];
				// 	$dia_nombre = $_POST['dia_nombre'];
				// 	$apertura = $_POST['apertura'];
				// 	$cierre = $_POST['cierre'];

				// 	$added = $this->usuariop->agregarTurno($_SESSION['user_id'], $dia_nombre, $dia, $apertura, $cierre);
					
				// 	if ($added) {
				// 		redirect('usuariop/edit_turnos');
				// 	}
				// }
				if (isset($_POST['update_horario'])) {
					$id = $_POST['id_dia'];
					$hora_inicio = $_POST['hora_inicio'];
					$hora_fin = $_POST['hora_fin'];

					$updated = $this->usuariop->updateHorario($id, $hora_inicio, $hora_fin);
					
					if ($updated) {
						redirect('usuariop/edit_turnos');
					}
				}

				if (isset($_POST['delete_horario'])) {
					$id = $_POST['id_dia'];

					$deleted = $this->usuariop->eliminarHorario($id);
					
					if ($deleted) {
						redirect('usuariop/edit_turnos');
					}
				}

				$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
				$horas = $this->usuariop->getHoras();
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
				$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
				// $turnos = $this->usuariop->getTurnosByUser($_SESSION['user_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
					// 'turnos' => $turnos,
					'horas' => $horas,
					'horarios' => $horarios,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/edit_turnos',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function perfil() {
			if (usuariopLoggedIn()) {

				if (isset($_POST['create_imagen_perfil'])) {

					$imagen = $_FILES['imagen']['name'];

			  	if ($imagen) {

			  		$archivo = $_FILES['imagen'];
						$user_id = $_SESSION['user_id'];

		      	if(file_exists('../public/files/perfiles/' . $user_id)) {
							$filesDir = '../public/files/perfiles/' . $user_id . '/';
		      	} else {
		    			mkdir('../public/files/perfiles/' . $user_id);
							$filesDir = '../public/files/perfiles/' . $user_id . '/';
		      	}


	        	$i_name = $archivo['name'];
						$i_tmp = $archivo['tmp_name'];

						move_uploaded_file($i_tmp, $filesDir . $i_name);

						$urlImagen = '/files/perfiles/' . $user_id . '/' . $i_name;

		        $added = $this->usuariop->createImagenPerfil($_SESSION['user_id'], $urlImagen);

		        if ($added) {
				      redirect('usuariop/perfil');
						} else {
							die('ocurrio un error');
						}

		      }

				}


				if (isset($_POST['add_horario'])) {
					$dia = $_POST['dia'];
					$estado = $_POST['estado'];
					$dia_nombre = $_POST['dia_nombre'];

					$added = $this->usuariop->agregarHorario($_SESSION['user_id'], $dia_nombre, $dia, $estado);
					
					if ($added) {
						redirect('usuariop/perfil');
					}
				}


				if (isset($_POST['add_profesion'])) {
					
					$id_profesion = $_POST['profesion'];

					$added = $this->usuariop->agregarProfesion($_SESSION['user_id'], $id_profesion);
					
					if ($added) {
						redirect('usuariop/perfil');
					}

				}


				$perfil = $this->usuariop->getUserById($_SESSION['user_id']);
				$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
				$modalidades = $this->page->getModalidades();
				$zonas = $this->page->getZonas();
				$localidades = $this->page->getLocalidades();
				
				$diasHabiles = [];
				$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
				foreach($horarios as $row) {
					array_push($diasHabiles, $row->dia);
				}

				$listaProfesiones = $this->admin->getProfesiones();
				$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
				$dias = [ 1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];

				$data = [
					'perfil' => $perfil,
					'imagenes_perfil' => $imagenes_perfil,
					'zonas' => $zonas,
					'localidades' => $localidades,
					'modalidades' => $modalidades,
					'diasHabiles' => $diasHabiles,
					'dias' => $dias,
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


		public function publicar($id_profesion = null) {
			if (usuariopLoggedIn()) {
				if(is_null($id_profesion)) {

					$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
					$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
					$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);
					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

					$zonas = $this->usuariop->getZonas();
					$data = [
						'imagenes_perfil' => $imagenes_perfil,
						'horarios' => $horarios,
						'profesiones' => $profesiones,
						'sidebar' => $sidebar,
						'zonas' => $zonas,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('usuariop/publicar', $data);

				} else {

					if ($_SERVER['REQUEST_METHOD'] == 'POST') {

						$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
						$user_id = $_POST['user_id'];
						$descripcion = $_POST['descripcion'];
						$duracion = $_POST['duracion'];
						$descuento = $_POST['descuento'];
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

				        $saved = $this->usuariop->savePublic($user_id, $descripcion, $urlImagen, $duracion, $servicio, $descuento);

				        if ($saved) {
						      $_SESSION['msg'] = 'saved';
									redirect('usuariop/index');
								} else {
									die('ocurrio un error');
								}

				      }



					} else {

						$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
						$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
						$servicios = $this->usuariop->getServiciosByUser($_SESSION['user_id'], $id_profesion);
						$profesion = $this->usuariop->getProfesionById($id_profesion);

						$zonas = $this->usuariop->getZonas();
						$data = [
							'imagenes_perfil' => $imagenes_perfil,
							'horarios' => $horarios,
							'profesion' => $profesion,
							'servicios' => $servicios,
							'sidebar' => $sidebar,
							'zonas' => $zonas,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];

						$this->view('usuariop/publicar', $data);
					}

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