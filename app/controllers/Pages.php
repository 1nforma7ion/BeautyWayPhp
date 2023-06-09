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

			if (notSession()) {

				$data = [
					// 'comic' => $project,
					// 'chapter' => $chapter,

					// 'project_name' => $name,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('pages/galeria', $data);
			}

		}

		public function login() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$email = $_POST['email'];
				$password = $_POST['password'];

				$userExists = $this->page->findEmail($email);

				if ($userExists) {
					$user_pass = $userExists->contrasenia;

					if (password_verify($password, $user_pass)) {
						// echo "<pre>";
						// print_r($userExists);
						// die();

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

			$_SESSION['user_id'] = $user->user_id;
			$_SESSION['user_rol'] = $user->rol;
			$_SESSION['user_email'] = $user->email;
			$_SESSION['user_nombre'] = $user->nombre;
			$_SESSION['user_telefono'] = $user->telefono;

			if ($user->rol == 'admin') {
				redirect('admin/panel');
			}

			if ($user->rol == 'usuario') {
				redirect('usuario/index');
			}

			if ($user->rol == 'usuariop') {
				redirect('usuariop/index');
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

		public function forgot() {
			if (notSession()) {
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

					$email = $_POST['email'];

					$userEmail = $this->page->findEmail($email);

					if ($userEmail) {
						$token = bin2hex(random_bytes(10));

						$this->page->saveToken($email, $token);

						$controller = strtolower(get_called_class());

						$to_email = $email;
						$subject = "Recuperación de contraseña";
						$body = 'Si solicitaste cambiar tu contraseña entra al siguiente <a href="' . URLROOT . '/' . $controller . '/change_password/' . $token . '"> enlace </a>';
						$headers = "From: niceDev90 <inbox@nicedev90.pro> \r\n";
			      $headers .= "MIME-Version: 1.0 \r\n";
						$headers .= "Content-type: text/html; charset='utf-8' \r\n";

	 							// send Mail to user email 
							// echo $body;
							// die();
						if (mail($to_email, $subject, $body, $headers)) {
							$data = [
								'email' => $email
							];
							$this->view('pages/pending', $data);
						} else {
							$_SESSION['msg'] = 'Algo salio mal.';
							redirect('pages/forgot');
						}



					} else {
						$_SESSION['msg'] = 'Email no registrado.';
						redirect('pages/forgot');
					}

				} else {

					$data = [
						// 'comic' => $project,
						// 'chapter' => $chapter,

						// 'project_name' => $name,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('pages/forgot', $data);

				}
			}
		}

		public function pending() {
			if (notSession()) {

				$data = [
					// 'comic' => $project,
					// 'chapter' => $chapter,

					// 'project_name' => $name,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('pages/pending', $data);	
			}
		}



		public function change_password($token = null) {
			if (!is_null($token)) {
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

					$email = $_POST['email'];
					$password = $_POST['contrasenia'];
					$confirm_password = $_POST['repetirContrasenia'];

					if ($password == $confirm_password) {

						$password = password_hash($password, PASSWORD_DEFAULT);

						$updated = $this->page->updatePassByToken($email,$password);

						if ($updated) {
							$this->page->deleteToken($email);
							$_SESSION['msg'] = 'Actualizado correctamente.';
							redirect('pages/login');
						} else {
							$_SESSION['msg'] = 'Ocurrió un error.';
							redirect('pages/change_password');
						}
					} 

				} else {
					$email = $this->page->getUserByToken($token);

					$data = [
						// 'comic' => $project,
						// 'chapter' => $chapter,

						// 'project_name' => $name,
						'token' => $token,
						'email' => $email,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('pages/change_password', $data);	
				}
			} else {
				redirect('pages/login');
			}
		}


		public function userIp() {
			switch(true) {
				case(!empty($_SERVER['HTTP_X_REAL_IP'])):
					return $_SERVER['HTTP_X_REAL_IP'];
					break;
				case(!empty($_SERVER['HTTP_CLIENT_IP'])):
					return $_SERVER['HTTP_CLIENT_IP'];
					break;
				case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
					return $_SERVER['HTTP_X_FORWARDED_FOR'];
					break;
				default:
					return $_SERVER['REMOTE_ADDR'];
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
					$zonas = $this->page->getZonas();
					$localidades = $this->page->getLocalidades();
					$modalidades = $this->page->getmodalidades();
					$tipo_docs = $this->page->getTipoDocs();


					$data = [
						'profesiones' => $profesiones,
						'zonas' => $zonas,
						'modalidades' => $modalidades,
						'tipo_docs' => $tipo_docs,
						'localidades' => $localidades,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('pages/registrar', $data);
				}

		}


		
	}
?>