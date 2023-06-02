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

		public function galeria($name = null, $chapter = null) {
			if (!is_null($name) && is_null($chapter)) {
				
				$project_name = str_replace("_"," ",$name);
				$controller = strtolower(get_called_class());

				$project = $this->page->getComic($project_name);

				$project_id = $project->id;
				$estado1 = 'publicado';
				$chapters = $this->page->getChapters($project_id,$estado1);

				$estado2 = 'programado';
				$upcoming = $this->page->getUpcoming($project_id,$estado2);

				$data = [
					'comic' => $project,
					'chapters' => $chapters,
					'upcoming' => $upcoming,

					'project_name' => $name,
					'controller' => $controller,
					'page' => __FUNCTION__
				];

				// echo "<pre>";

				// print_r($data);

				// die();

				$this->view('pages/galeria', $data);

			} 

			if (!is_null($name) && !is_null($chapter)) {
				$project_name = str_replace("_"," ",$name);
				$controller = strtolower(get_called_class());
				
				$project = $this->page->getComic($project_name);
				$project_id = $project->id;

				$chapter_num = explode('_', $chapter);
				$chapter_num = $chapter_num[1];
				$chapter = $this->page->getDataChapter($project_id,$chapter_num);

				$data = [
					'comic' => $project,
					'chapter' => $chapter,

					'project_name' => $name,
					'controller' => $controller,
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
				$this->view('pages/login');
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

		public function register() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$nombre = $_POST['nombre'];
				$email = $_POST['email'];
				$telefono = $_POST['telefono'];
				$password = $_POST['password'];
	
				$userExists = $this->page->findEmail($email);

				if ($userExists) {
					$_SESSION['msg'] = 'El email ya se encuentra registrado.';
					redirect('pages/register');
				} else {
					$password = password_hash($password, PASSWORD_DEFAULT);
					$rol = 2;
					$this->page->register($rol,$nombre,$email,$password,$telefono);

					$_SESSION['msg'] = 'Registrado Correctamente.';
					redirect('pages/login');
				}

			} else {
				$this->view('pages/register');
			}
		}


		
	}
?>