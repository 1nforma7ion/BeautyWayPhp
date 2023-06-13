<?php 
	class Usuariop extends Controller {
		public function __construct() {
			$this->usuariop = $this->model('Userp');
		}

		public function index() {
			if (usuariopLoggedIn()) {


				$data = [

					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('usuariop/index',$data);

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
					
					$zonas = $this->usuariop->getZonas();
					$data = [
						// 'comic' => $project,
						// 'chapter' => $chapter,

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