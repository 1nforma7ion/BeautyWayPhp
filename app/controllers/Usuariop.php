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
				$publicaciones = $this->usuariop->getPublicacionesByUser($_SESSION['user_id']);

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

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
							// se modifica $hora_inicio en cada iteracion
							$hora_inicio = intval($hora_inicio) + $dur_turno;

							$turnos[$k] = [
								// la $hora_inicio aumenta en cada iteracion
								'hora_inicio' => ($hora_inicio - $dur_turno) . ':00',
								'hora_fin' => $hora_inicio . ':00',
							];
						}	

					$result=[];
						for($c = 0; $c < count($dia); $c++) {
							// call to helper functin setTurnos
							$result[$c] = setTurnos($turnos, $dia[$c]);
						}

					$added = $this->usuariop->agregarHorario($result);
					
					if ($added) {
						redirect('usuariop/edit_turnos');
					}
				}

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
				
				$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
				
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
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

				if (isset($_POST['update_imagen_perfil'])) {

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

		        $added = $this->usuariop->updateImagenPerfil($_SESSION['user_id'], $urlImagen);

		        if ($added) {
				      redirect('usuariop/perfil');
						} else {
							die('ocurrio un error');
						}

		      }

				}

				if(isset($_POST['update_perfil'])) {
					ob_start();
					
					$nombre = $_POST['nombre'];
					$apellido = $_POST['apellido'];
					$telefono = $_POST['telefono'];

					$updated = $this->usuariop->updatePerfil($_SESSION['user_id'],$nombre, $apellido, $telefono);

					if ($updated) {
						
						$_SESSION['msg'] = 'Perfil Actualizado.';

						$perfil = $this->usuariop->getUserById($_SESSION['user_id']);
						$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
						$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);

						$modalidades = $this->page->getModalidades();
						$zonas = $this->page->getZonas();
						$localidades = $this->page->getLocalidades();
						$listaProfesiones = $this->admin->getProfesiones();

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

						$data = [
							'perfil' => $perfil,
							'imagenes_perfil' => $imagenes_perfil,
							'zonas' => $zonas,
							'localidades' => $localidades,
							'modalidades' => $modalidades,
							'profesiones' => $profesiones,
							'listaProfesiones' => $listaProfesiones,
							'sidebar' => $sidebar,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];

						$this->view('usuariop/perfil',$data);					
					}
					 
				}

				if(isset($_POST['update_comercial'])) {
					ob_start();
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

					$calle = $_POST['calle'];
					$altura = $_POST['altura'];
					$piso = $_POST['piso'];
					$depto = $_POST['depto'];
					$barrio = $_POST['barrio'];
					$localidad = $_POST['localidad'];
					$comercial = $_POST['nombre_comercial'];
					$modalidad = $_POST['modalidad'];
					$zona = $_POST['zona'];


					$updated = $this->usuariop->updateComercial($_SESSION['user_id'],$comercial, $modalidad, $localidad, $zona,$calle,$altura,$piso,$depto,$barrio);

					if ($updated) {
						
						$_SESSION['msg'] = 'Perfil Actualizado.';

						$perfil = $this->usuariop->getUserById($_SESSION['user_id']);
						$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
						$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);

						$modalidades = $this->page->getModalidades();
						$zonas = $this->page->getZonas();
						$localidades = $this->page->getLocalidades();
						$listaProfesiones = $this->admin->getProfesiones();

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

						$data = [
							'perfil' => $perfil,
							'imagenes_perfil' => $imagenes_perfil,
							'zonas' => $zonas,
							'localidades' => $localidades,
							'modalidades' => $modalidades,
							'profesiones' => $profesiones,
							'listaProfesiones' => $listaProfesiones,
							'sidebar' => $sidebar,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];

						$this->view('usuariop/perfil',$data);					
					}
					 
				}

				if(isset($_POST['change_password'])) {

					$password = $_POST['contrasenia'];
					$confirm_password = $_POST['repetirContrasenia'];

					if ($password == $confirm_password) {

						$password = password_hash($password, PASSWORD_DEFAULT);

						$updated = $this->usuariop->updatePassword($_SESSION['user_id'],$password);

						if ($updated) {
							
							$_SESSION['msg'] = 'Contraseña Actualizada.';

							$perfil = $this->usuariop->getUserById($_SESSION['user_id']);
							$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
							$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);

							$modalidades = $this->page->getModalidades();
							$zonas = $this->page->getZonas();
							$localidades = $this->page->getLocalidades();
							$listaProfesiones = $this->admin->getProfesiones();

							$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

							$data = [
								'perfil' => $perfil,
								'imagenes_perfil' => $imagenes_perfil,
								'zonas' => $zonas,
								'localidades' => $localidades,
								'modalidades' => $modalidades,
								'profesiones' => $profesiones,
								'listaProfesiones' => $listaProfesiones,
								'sidebar' => $sidebar,
								'controller' => strtolower(get_called_class()),
								'page' => __FUNCTION__
							];

							$this->view('usuariop/perfil',$data);	

						}
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
				$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);

				$modalidades = $this->page->getModalidades();
				$zonas = $this->page->getZonas();
				$localidades = $this->page->getLocalidades();
				$listaProfesiones = $this->admin->getProfesiones();

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'perfil' => $perfil,
					'imagenes_perfil' => $imagenes_perfil,
					'zonas' => $zonas,
					'localidades' => $localidades,
					'modalidades' => $modalidades,
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

					$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
					$profesion = $this->usuariop->getProfesionById($id_profesion);
					$listaServicios = $this->usuariop->getServiciosByUser($_SESSION['user_id'], $id_profesion);
					$todosServicios = $this->usuariop->getTodosServiciosById($id_profesion);

					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

					$data = [
						'profesion' => $profesion,
						'imagenes_perfil' => $imagenes_perfil,
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


		public function publicar($id_profesion = null) {
			if (usuariopLoggedIn()) {
				if(is_null($id_profesion)) {
					// verificar imagenes_perfil y servicios
					$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
					$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
					$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);
					$zonas = $this->page->getZonas();

					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

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

				        $saved = $this->usuariop->savePublic($user_id, $descripcion, $urlImagen, $servicio, $descuento);

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
						$servicios = $this->usuariop->getServiciosByUser($_SESSION['user_id'], $id_profesion);
						$profesion = $this->usuariop->getProfesionById($id_profesion);
						$zonas = $this->page->getZonas();

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

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



		public function reservas() {
			if (usuariopLoggedIn()) {

				if (isset($_POST['edit_reserva'])) {
					ob_start();

					$id_reserva = $_POST['id_reserva'];
					$status = $_POST['status'];
					$motivo = $_POST['motivo'];

					$updated = $this->usuariop->updateReservaStatus($id_reserva, $status, $motivo);

					if ($updated) {
						$estado = 1;
						$id_profesional = $_SESSION['user_id'];
						$dia = $_POST['dia'];
						$hora_inicio = $_POST['hora_inicio'];

						$this->usuariop->updateTurnosByUser($id_profesional, $dia, $hora_inicio, $estado);

						$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
						$reservas = $this->usuariop->getReservasByUser($_SESSION['user_id']);
						$reservas_estados = $this->usuariop->readReservaEstados();
						$reservas_motivos = $this->usuariop->readReservaMotivos();

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

						$data = [
							'imagenes_perfil' => $imagenes_perfil,
							'reservas' => $reservas,
							'reservas_motivos' => $reservas_motivos,
							'reservas_estados' => $reservas_estados,
							'sidebar' => $sidebar,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];
						

						$_SESSION['msg'] = "Reserva Actualizada.";
						$this->view('usuariop/reservas',$data);

					}
				}


				$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
				$reservas = $this->usuariop->getReservasByUser($_SESSION['user_id']);
				$reservas_estados = $this->usuariop->readReservaEstados();
				$reservas_motivos = $this->usuariop->readReservaMotivos();

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
					'reservas' => $reservas,
					'reservas_motivos' => $reservas_motivos,
					'reservas_estados' => $reservas_estados,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/reservas',$data);

			} else {
				redirect('pages/login');
			}
		}



		public function mensajes($success = null) {
			if (usuariopLoggedIn()) {

				if (isset($_POST['responder_mensaje'])) {
					$recibido_por = $_POST['recibido_por'];
					$enviado_por = $_SESSION['user_id'];
					$mensaje = $_POST['mensaje'];

					$added = $this->usuariop->createMensaje($recibido_por, $enviado_por, $mensaje);
					if ($added) {

						$_SESSION['msg'] = 'Mensaje Enviado';

						$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
						$mensajes = $this->usuariop->getMensajesById($_SESSION['user_id']);

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

						$data = [
							'success' => $success,
							'imagenes_perfil' => $imagenes_perfil,
							'mensajes' => $mensajes,
							'sidebar' => $sidebar,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];

						$this->view('usuariop/mensajes',$data);
					}
				}


				$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
				$mensajes = $this->usuariop->getMensajesById($_SESSION['user_id']);

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'success' => $success,
					'imagenes_perfil' => $imagenes_perfil,
					'mensajes' => $mensajes,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/mensajes',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function reportes() {
			if (usuariopLoggedIn()) {

				if (isset($_POST['edit_reserva'])) {
					ob_start();

					$id_reserva = $_POST['id_reserva'];
					$status = $_POST['status'];
					$motivo = $_POST['motivo'];

					$updated = $this->usuariop->updateReservaStatus($id_reserva, $status, $motivo);

					if ($updated) {
						$estado = 1;
						$id_profesional = $_SESSION['user_id'];
						$dia = $_POST['dia'];
						$hora_inicio = $_POST['hora_inicio'];

						$this->usuariop->updateTurnosByUser($id_profesional, $dia, $hora_inicio, $estado);

						$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
						$reservas = $this->usuariop->getReservasByUser($_SESSION['user_id']);
						$reservas_estados = $this->usuariop->readReservaEstados();
						$reservas_motivos = $this->usuariop->readReservaMotivos();

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

						$data = [
							'imagenes_perfil' => $imagenes_perfil,
							'reservas' => $reservas,
							'reservas_motivos' => $reservas_motivos,
							'reservas_estados' => $reservas_estados,
							'sidebar' => $sidebar,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];
						

						$_SESSION['msg'] = "Reserva Actualizada.";
						$this->view('usuariop/reservas',$data);

					}
				}


					
				$usuarios = $this->admin->getUsuarios();

				$imagenes_perfil = $this->usuariop->getImageById($_SESSION['user_id']);
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'usuarios' => $usuarios,
					'imagenes_perfil' => $imagenes_perfil,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/reportes',$data);

			} else {
				redirect('pages/login');
			}
		}




	}
?>