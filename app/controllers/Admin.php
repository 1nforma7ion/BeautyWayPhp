<?php 
	class Admin extends Controller {
		
		public function __construct() {
			$this->admin = $this->model('Administrador');
		}

		public function index() {
			if (adminLoggedIn()) {
				$projects = $this->admin->getProjects();
				$name = $projects[0]->nombre;
				$project_name = str_replace(" ","_",$name);
				$controller = strtolower(get_called_class());

				$data = [
					'comics' => $projects,

					'project_name' => $project_name,
					'controller' => $controller,
					'page' => __FUNCTION__
				];

				$this->view('admin/index',$data);

			} else {
				$this->view('pages/login');
			}
		}

		public function panel() {
			if (adminLoggedIn()) {
				$projects = $this->admin->getProjects();
				$name = $projects[0]->nombre;
				$project_name = str_replace(" ","_",$name);
				$controller = strtolower(get_called_class());

				$chapters = $this->admin->getAllChapters();
				$users = $this->admin->getUsers();

				$data = [
					'comics' => $projects,
					'chapters' => $chapters,
					'users' => $users,

					'project_name' => $project_name,
					'controller' => $controller,
					'page' => __FUNCTION__
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('admin/panel',$data);

			} else {
				$this->view('pages/login');
			}
		}

		public function about() {
			if (adminLoggedIn()) {
				$projects = $this->admin->getProjects();
				$name = $projects[0]->nombre;
				$project_name = str_replace(" ","_",$name);
				$controller = strtolower(get_called_class());

				$authors = $this->admin->getAuthors();

				$data = [
					'authors' => $authors,

					'project_name' => $project_name,
					'controller' => $controller,
					'page' => __FUNCTION__
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('admin/about',$data);

			} else {
				$this->view('pages/login');
			}
		}

}
?>