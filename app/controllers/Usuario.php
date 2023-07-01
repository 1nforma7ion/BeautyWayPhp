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


		public function mensajes($success = null) {
			if (usuarioLoggedIn()) {

				if (isset($_POST['responder_mensaje'])) {
					$recibido_por = $_POST['recibido_por'];
					$enviado_por = $_SESSION['user_id'];
					$mensaje = $_POST['mensaje'];

					$added = $this->usuario->createMensaje($recibido_por, $enviado_por, $mensaje);
					if ($added) {
						$success = 1;
						redirect('usuario/mensajes/' . $success );
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

				$reservas = $this->usuario->getReservasByUser($_SESSION['user_id']);
				$data = [
					'reservas' => $reservas,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuario/reservas',$data);

			} else {
				redirect('pages/login');
			}
		}


		public function reservar() {
			if (usuarioLoggedIn()) {

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
				$horarios = $this->usuario->getHorarios($_SESSION['user_id']);
				$turnos = $this->usuario->getTurnosByUser($_SESSION['user_id']);

				$data = [
					'turnos' => $turnos,
					'horarios' => $horarios,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuario/reservar',$data);

			} else {
				redirect('pages/login');
			}
		}



		
	}
?>