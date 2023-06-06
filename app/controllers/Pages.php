<?php 
	class Pages extends Controller {
		public function __construct() {
			$this->page = $this->model('Page');
		}

		public function index() {
			if (notSession()) {

				$controller = strtolower(get_called_class());

				$data = [

					'controller' => $controller,
					'page' => __FUNCTION__
				];

				$this->view('pages/index',$data);

			} else {
				$this->view('pages/login');
			}
		}

		public function about() {
			if (notSession()) {
				$projects = $this->page->getProjects();
				$name = $projects[0]->nombre;
				$project_name = str_replace(" ","_",$name);
				$controller = strtolower(get_called_class());

				$authors = $this->page->getAuthors();

				$data = [
					'authors' => $authors,

					'project_name' => $project_name,
					'controller' => $controller,
					'page' => __FUNCTION__
				];

				$this->view('pages/about',$data);
			} else {
				$this->view('pages/login');
			}
		}

		public function galeria() {


				$data = [
					// 'comic' => $project,
					// 'chapter' => $chapter,

					// 'project_name' => $name,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('pages/galeria', $data);

		}

		public function login() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$email = $_POST['email'];
				$password = $_POST['password'];

				$userExists = $this->page->findEmail($email);


				if ($userExists) {
					$user_pass = $userExists->password;

					if (password_verify($password, $user_pass)) {
						$this->createSession($userExists);
					} else {
						$_SESSION['msg'] = 'Contraseña incorrecta.';
						redirect('pages/login');
					}
				} else {
					$_SESSION['msg'] = 'Email no registrado.';
					redirect('pages/login');
				}

			} else {
				$controller = strtolower(get_called_class());

				$data = [
					'controller' => $controller,
					'page' => __FUNCTION__
				];

				$this->view('pages/login', $data);
			}
		}

		public function createSession($user) {

			$nombre = explode(' ', $user->nombre);
			$nombre = $nombre[0];

			$_SESSION['user_id'] = $user->user_id;
			$_SESSION['user_rol'] = $user->rol;
			$_SESSION['user_email'] = $user->email;
			$_SESSION['user_nombre'] = $nombre;
			$_SESSION['user_telefono'] = $user->telefono;

			if ($user->rol == 'admin') {
				redirect('admin/panel');
			}

			if ($user->rol == 'usuario') {
				redirect('usuarios/index');
			}
		}

		public function logout() {
			unset($_SESSION['user_id']);
			unset($_SESSION['user_rol']);
			unset($_SESSION['user_email']);
			unset($_SESSION['user_nombre']);
			unset($_SESSION['user_telefono']);

			session_destroy();
			redirect('pages/index');
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