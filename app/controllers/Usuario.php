<?php 
	class Usuario extends Controller {
		public function __construct() {
			$this->usuario = $this->model('User');
			$this->admin = $this->model('Administrador');
			$this->page = $this->model('Page');
		}

		public function index() {
			if (usuarioLoggedIn()) {

				$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);
				$publicaciones = $this->page->getAllPublicaciones();

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
					'publicaciones' => $publicaciones,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuario/index',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function detalles($id_profesional=null, $id_public = null) {
			if (usuarioLoggedIn()) {

				if (isset($_POST['crear_reserva'])) {
					ob_start();

					$user_id = $_SESSION['user_id'];
					$servicio = $_POST['servicio'];
					$dia = $_POST['dia'];
					$turno = $_POST['turno'];
					$status = 'pendiente';

					$turno = explode('-', $turno);
					$hora_inicio = $turno[0];
					$hora_fin = $turno[1];

					$added = $this->usuario->createReserva($user_id, $id_profesional, $id_public, $servicio, $dia, $hora_inicio, $hora_fin, $status);
					if ($added) {
						$estado = 0;
						$this->usuario->updateTurnosByUser($id_profesional, $dia, $hora_inicio, $estado);
						
							$recibido_por = $id_profesional;
							$enviado_por = $_SESSION['user_id'];
							$mensaje = "Solicita una reserva el dia " . $dia . " en el turno de " . $hora_inicio . "hrs.";
							$this->usuario->createMensaje($recibido_por, $enviado_por, $mensaje);

						$_SESSION['success_msg'] = "Reserva Creada Exitosamente.";
						redirect('usuario/reservas');
					}
				}


				$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);
				$publicacion = $this->usuario->getPublicById($id_public);
				$dias = $this->usuario->getDiasByUser($id_profesional);

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
					'dias' => $dias,
					'publicacion' => $publicacion,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuario/detalles',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function turnos($id_profesional = null, $dia=null) {

			$turnos = $this->usuario->getTurnosByUser($id_profesional,$dia);

			// convertir PDO objecto to array & send to frontend page
			echo json_encode($turnos);
			// echo $turnos;
			// print_r($turnos);
		}

		public function mensajes($success = null) {
			if (usuarioLoggedIn()) {

				if (isset($_POST['responder_mensaje'])) {
					ob_start();

					$recibido_por = $_POST['recibido_por'];
					$enviado_por = $_SESSION['user_id'];
					$mensaje = $_POST['mensaje'];

					$added = $this->usuario->createMensaje($recibido_por, $enviado_por, $mensaje);
					if ($added) {
						$_SESSION['msg'] = "enviado correctamente";

						$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);
						$mensajes = $this->usuario->getMensajesById($_SESSION['user_id']);

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

						$data = [
							'success' => $success,
							'imagenes_perfil' => $imagenes_perfil,
							'mensajes' => $mensajes,
							'sidebar' => $sidebar,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];

						$this->view('usuario/mensajes', $data);

					}
				}


				$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);
				$mensajes = $this->usuario->getMensajesById($_SESSION['user_id']);

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'success' => $success,
					'imagenes_perfil' => $imagenes_perfil,
					'mensajes' => $mensajes,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuario/mensajes',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function reservas() {
			if (usuarioLoggedIn()) {

				if (isset($_POST['edit_reserva'])) {
					ob_start();

					$id_reserva = $_POST['id_reserva'];
					$hora_inicio = $_POST['hora_inicio'];
					$id_profesional = $_POST['id_profesional'];
					$dia = $_POST['dia'];

					$status = 'cancelado';
					$updated = $this->usuario->updateReservaStatus($id_reserva, $status);

					if ($updated) {
						$estado = 1;
						$this->usuario->updateTurnosByUser($id_profesional, $dia, $hora_inicio, $estado);
						$_SESSION['success_msg'] = "Reserva Cancelada.";
						redirect('usuario/reservas');
					}
				}


				$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);
				$reservas = $this->usuario->getReservasByUser($_SESSION['user_id']);

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
					'reservas' => $reservas,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuario/reservas',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function perfil() {
			if (usuarioLoggedIn()) {

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

		        $added = $this->usuario->createImagenPerfil($_SESSION['user_id'], $urlImagen);

		        if ($added) {
				      redirect('usuario/perfil');
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

					$updated = $this->usuario->updatePerfil($_SESSION['user_id'],$nombre, $apellido, $telefono);

					if ($updated) {
						
						$_SESSION['msg'] = 'Perfil Actualizado.';

						$perfil = $this->usuario->getUserById($_SESSION['user_id']);
						$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);

						$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

						$data = [
							'perfil' => $perfil,
							'imagenes_perfil' => $imagenes_perfil,

							'sidebar' => $sidebar,
							'controller' => strtolower(get_called_class()),
							'page' => __FUNCTION__
						];

						$this->view('usuario/perfil',$data);
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

		        $added = $this->usuario->updateImagenPerfil($_SESSION['user_id'], $urlImagen);

		        if ($added) {
				      redirect('usuario/perfil');
						} else {
							die('ocurrio un error');
						}

		      }

				}


				if(isset($_POST['change_password'])) {

					$password = $_POST['contrasenia'];
					$confirm_password = $_POST['repetirContrasenia'];

					if ($password == $confirm_password) {

						$password = password_hash($password, PASSWORD_DEFAULT);

						$updated = $this->usuario->updatePassword($_SESSION['user_id'],$password);

						if ($updated) {
							
							$_SESSION['msg'] = 'Contraseña Actualizada.';

							$perfil = $this->usuario->getUserById($_SESSION['user_id']);
							$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);

							$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

							$data = [
								'perfil' => $perfil,
								'imagenes_perfil' => $imagenes_perfil,

								'sidebar' => $sidebar,
								'controller' => strtolower(get_called_class()),
								'page' => __FUNCTION__
							];

							$this->view('usuario/perfil',$data);
						}
					} 

				}

				$perfil = $this->usuario->getUserById($_SESSION['user_id']);
				$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);


				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'perfil' => $perfil,
					'imagenes_perfil' => $imagenes_perfil,

					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuario/perfil',$data);

			} else {
				redirect('pages/login');
			}
		}


		
	}
?>