<?php 
	class Pages extends Controller {
		public function __construct() {
			$this->page = $this->model('Page');
			$this->admin = $this->model('Administrador');
		}

		public function index() {
			if (notSession()) {
				
				$publicaciones = $this->page->getAllPublicaciones();
				$descuentos = $this->page->getAllDescuentos();

				$data = [
					'descuentos' => $descuentos,
					'publicaciones' => $publicaciones,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];
				$this->view('pages/index',$data);
			} else {
				redirect('pages/login');
			}
		}

		public function condiciones() {
			if (notSession()) {
				
				$condiciones = $this->admin->readCondiciones();
				$descuentos = $this->page->getAllDescuentos();
				
				$data = [
					'descuentos' => $descuentos,
					'condiciones' => $condiciones,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('pages/condiciones',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function login() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$email = $_POST['email'];
				$password = $_POST['password'];

				$userExists = $this->page->findEmail($email);

					if ($userExists) {

						if($userExists->user_estado == 1) {
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
							$_SESSION['msg'] = 'Usuario Inactivo.';
							redirect('pages/login');		
						}
						

					} else {
						$_SESSION['msg'] = 'Email no registrado.';
						redirect('pages/login');
					}

			} else {

				$data = [
					'controller' => strtolower(get_called_class()),
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
			$_SESSION['user_apellido'] = $user->apellido;
			$_SESSION['user_telefono'] = $user->telefono;
			$_SESSION['user_nombre_comercial'] = $user->nombre_comercial;
			$_SESSION['user_modalidad'] = $user->modalidad;
			$_SESSION['user_calle'] = $user->calle;
			$_SESSION['user_altura'] = $user->altura;
			$_SESSION['user_localidad'] = $user->localidad;
			$_SESSION['user_zona'] = $user->zona;
			$_SESSION['user_barrio'] = $user->barrio;
			$_SESSION['user_id_profesion'] = $user->id_profesion;
			$_SESSION['user_rol_id'] = $user->rol_id;

			if ($user->rol == 'admin') {
				redirect('admin/reportes');
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
			unset($_SESSION['user_apellido']);
			unset($_SESSION['user_telefono']);
			unset($_SESSION['user_nombre_comercial']);
			unset($_SESSION['user_modalidad']);
			unset($_SESSION['user_calle']);
			unset($_SESSION['user_altura']);
			unset($_SESSION['user_localidad']);
			unset($_SESSION['user_zona']);
			unset($_SESSION['user_barrio']);
			unset($_SESSION['user_rol_id']);

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

						$email_to_user = $this->sendEmail($email, $token);

							// echo $body;
							// die();
						// if (mail($to_email, $subject, $body, $headers)) {
						if ($email_to_user) {
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
					$estado = 1; //activo

					$profesion = $_POST['profesion'];
					
					if(!empty($_POST['nombre_comercial'])) {
						$rol = ID_USER_PRO;
						$modalidad = $_POST['modalidad'];
						$zona = $_POST['zona'];
					} else {
						$rol = ID_USER_NORMAL;
						$modalidad = $_POST['modalidad_usuario'];
						$zona = $_POST['zona_usuario'];
					}

					if ($pass !== $rep_pass) {
						$_SESSION['msg'] = 'Contraseñas no coinciden.';
						redirect('pages/registrar');
					}

					// $invite = implode(', ', $_POST['profesion']);
					// echo $invite;

					// echo "<pre>";
					// print_r($_POST);
					// die();
		
					$userExists = $this->page->findEmail($email);
					$docExists = $this->page->findDocumento($doc);

					if ($userExists) {
						$_SESSION['msg'] = 'El email ya se encuentra registrado.';
						redirect('pages/registrar');
					} else {
						if ($docExists) {
							$_SESSION['msg'] = 'El Documento ya se encuentra registrado.';
							redirect('pages/registrar');
						} else {
							$pass = password_hash($pass, PASSWORD_DEFAULT);

							$created = $this->page->register($rol,$tipo,$doc,$nombre,$apellido,$calle,$altura,$piso,$depto,$barrio,$localidad,$telefono,$email,$pass,$comercial,$profesion,$modalidad,$zona, $estado);
							
							if($created) {
								$this->sendEmailNewUser($email, $nombre, $apellido);
								$_SESSION['msg'] = 'Registrado Correctamente.';
								redirect('pages/login');
							} else {
								$_SESSION['msg'] = 'Error al Registrar.';
								redirect('pages/login');	
							}
							
						}
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


		public function buscar($term = null, $pageNum = null) {

			if (isset($_POST['btn_buscar'])) {

				$busqueda = $_POST['term'];

				$paginacion = is_null($pageNum) ? 1 : $pageNum;
				$porPagina = NUM_POSTS_SEARCH;

				$total_resultados = $this->page->readAllTerms($busqueda);
	      $inicio = ($paginacion - 1) * $porPagina;
	      $total_pag = ceil($total_resultados / $porPagina);

	      $resultados = $this->page->readLimitTerms($busqueda, $inicio, $porPagina);

	      // echo "<pre>";
				// print_r($resultados);
				// die();

				$descuentos = $this->page->getAllDescuentos();

				$data = [
					'descuentos' => $descuentos,
					'termino' => $busqueda,
					'resultados' => $resultados,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				$this->view('pages/buscar', $data);

			}

		}

		public function sendEmail($email_user, $token) {
			$controller = strtolower(get_called_class());
						
			$subject = "Recuperación de contraseña";
			$body = 'Si solicitaste cambiar tu contraseña entra al siguiente <a href="' . URLROOT . '/' . $controller . '/change_password/' . $token . '"> enlace </a>';

			return $this->mailer($email_user, $subject, $body);
		}

		public function sendEmailNewUser($email, $nombre, $apellido) {
						
			$subject = "Bienvenido a Beauty Way !";
			$body = "Hola " . $nombre . " "  . $apellido . " ! <br><br>";
			$body .= "Te damos la Bienvenida  a nuestra plataforma ! <br><br> ";
			$body .= "Aqui encontraras los mejores servicios y descuentos exclusivos ! <br><br><br> ";
			$body .= 'Ya Puedes iniciar sesión en  <a href="' . URLROOT . '"> Beauty Way </a> <br><br>';

			return $this->mailer($email, $subject, $body);
		}

		public function mailer($email, $subject, $body) {
			$mail = new PHPMailer;                          
			$mail->isSMTP();
			$mail->SMTPDebug = SMTP_DEBUG;                            
			$mail->Host = SMTP_HOST;
			$mail->SMTPAuth = SMTP_AUTH;
			$mail->Port = SMTP_PORT;                  
			$mail->SMTPSecure = SMTP_SECURE;  

			$mail->Username = SMTP_USER;         
			$mail->Password = SMTP_PASS;          
                 
			$mail->From = SMTP_FROM; 
			$mail->FromName = SMTP_FROM_NAME; 
			$mail->addAddress($email); 
			$mail->isHTML(true); 
			$mail->Subject = utf8_decode($subject);
			$mail->Body = $body;
			$mail->CharSet = SMTP_CHARSET;

			if($mail->send()) {
				return true;
			} else {
				return false;
			}
		}

	}
?>