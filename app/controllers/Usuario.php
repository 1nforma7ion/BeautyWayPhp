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
				$allLikes = $this->usuario->readAllLiked($_SESSION['user_id']);

				$likes = [];

				foreach($allLikes as $like) {
					array_push($likes, $like->id_publicacion);
				}

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'allLikes' => $likes,
					'imagenes_perfil' => $imagenes_perfil,
					'publicaciones' => $publicaciones,
					'sidebar' => $sidebar,
					'controller' => strtolower(get_called_class()),
					'page' => __FUNCTION__
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('usuario/index',$data);

			} else {
				redirect('pages/login');
			}
		}

		public function detalles($id_profesional=null, $id_public = null) {
			if (usuarioLoggedIn()) {

				if (isset($_POST['create_comentario'])) {
					ob_start();

					$user_id = $_SESSION['user_id'];
					$comentario = $_POST['comentario'];

					$added = $this->usuario->createComentario($user_id, $id_public, $comentario);
					if ($added) {
						$this->usuario->updateComentariosPublic($id_public);
						
						redirect('usuario/detalles/' . $id_profesional . '/' . $id_public . '#comentarios');
					}
				}


				if (isset($_POST['crear_reserva'])) {
					ob_start();

					$user_id = $_SESSION['user_id'];
					$email_user = $_SESSION['user_email'];
					$email_prof = $_POST['email_prof'];
					$nombre_comercial = $_POST['nombre_comercial'];

					$servicio = $_POST['servicio'];
					$modalidad = $_POST['modalidad'];
					$direccion = $_POST['direccion'];
					$dia = $_POST['dia'];
					$turno = $_POST['turno'];
					$status = 'pendiente';

					$turno = explode('-', $turno);
					$hora_inicio = $turno[0];
					$hora_fin = $turno[1];

					$added = $this->usuario->createReserva($user_id, $id_profesional, $id_public, $servicio, $modalidad, $direccion, $dia, $hora_inicio, $hora_fin, $status);
					if ($added) {

						$estado = 0;
						$this->usuario->updateTurnosByUser($id_profesional, $dia, $hora_inicio, $estado);
						
						$recibido_por = $id_profesional;
						$enviado_por = $_SESSION['user_id'];
						$mensaje = "Solicita una reserva el dia " . $dia . " en el turno de " . $hora_inicio . "hrs.";
						$this->usuario->createMensaje($recibido_por, $enviado_por, $mensaje);

						$email_to_user = $this->sendEmailToUser($email_user, $nombre_comercial, $direccion, $modalidad, $servicio, $dia, $hora_inicio);
						$email_to_userp = $this->sendEmailToUserp($email_prof, $direccion, $modalidad, $servicio, $dia, $hora_inicio);	
										
						$_SESSION['success_msg'] = "Reserva Creada Exitosamente.";
						redirect('usuario/reservas');
						exit();

					}
				}


				$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);
				$publicacion = $this->usuario->getPublicById($id_public);
				$dias = $this->usuario->getDiasByUser($id_profesional);
				$comentarios = $this->usuario->readComentariosByPublic($id_public);
				$allLikes = $this->usuario->readAllLiked($_SESSION['user_id']);

				$likes = [];

				foreach($allLikes as $like) {
					array_push($likes, $like->id_publicacion);
				}

				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

				$data = [
					'comentarios' => $comentarios,
					'allLikes' => $likes,
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

		public function sendEmailToUserp($email_prof, $direccion, $modalidad, $servicio, $dia, $hora_inicio) {
			// sleep(10);
			$subject = "Tienes una Reserva en Beauty Way! ";
			$body = "Tienes una reserva por confirmar en Beauty Way ! <br><br>	";
			$body .= "Cliente : " . $_SESSION['user_nombre'] . " " . $_SESSION['user_apellido'] . " <br><br>";
			$body .= "Modalidad : " . $modalidad . "<br><br>";
			$body .= "Dirección : " . $direccion . "<br><br>";
			$body .= "Servicio : " . $servicio . "<br><br>";
			$body .= "Dia : " . $dia . "<br><br>";
			$body .= "Turno : " . $hora_inicio . " hrs. <br><br>";
			$body .= 'Ingresa a <a href="' . URLROOT . '"> Beauty Way  </a> para Confirmar la Reserva. ';

			$this->mailer($email_prof, $subject, $body);

		}


		public function sendEmailToUser($email_user, $nombre_comercial, $direccion, $modalidad, $servicio, $dia, $hora_inicio) {
			// sleep(15);
			$subject = "Has creado una Reserva en Beauty Way! ";
			$body = "Tienes una reserva por confirmar en Beauty Way ! <br><br>	";
			$body .= "Profesional : " . $nombre_comercial . " <br><br>";
			$body .= "Modalidad : " . $modalidad . "<br><br>";
			$body .= "Dirección : " . $direccion . "<br><br>";
			$body .= "Servicio : " . $servicio . "<br><br>";
			$body .= "Dia : " . $dia . "<br><br>";
			$body .= "Turno : " . $hora_inicio . " hrs. <br><br>";
			$body .= 'Recibirás un email cuando se Confirma la Reserva. ';

			$this->mailer($email_user, $subject, $body);

		}


		public function mailer($email, $subject, $body) {
			$mail = new PHPMailer;                          
			$mail->isSMTP();
			$mail->SMTPDebug = SMTP_DEBUG;                            
			$mail->Host = SMTP_HOST;
			$mail->SMTPAuth = SMTP_AUTH;
			$mail->Port = SMTP_PORT;                  
			$mail->SMTPSecure = SMTP_SECURE;  

			$mail->Username = SMTP_USER;  // email que envia el correo          
			$mail->Password = SMTP_PASS;  // pass del email que envia el correo          
                 
			$mail->From = SMTP_FROM; // email que aparecera en el contenido "From"
			$mail->FromName = SMTP_FROM_NAME; // nombre que aparecera en el contenido " SUPPORT BEAUTY WAY "
			$mail->addAddress($email); // email que recibe el correo
			$mail->isHTML(true); // habilitar contenido del email en HTML
			$mail->Subject = $subject;
			$mail->Body = $body;
			// $mail->AltBody = "This is the plain text version of the email content";

			if(!$mail->send()) {
				// echo "Mailer Error: " . $mail->ErrorInfo;
				return false;
			} else {
				// echo "Message has been sent successfully";
				return true;
			}
		}

		public function turnos($id_profesional = null, $dia=null) {


			$turnos = $this->usuario->getTurnosByUser($id_profesional,$dia);

			// convertir PDO objecto to array & send to frontend page
			echo json_encode($turnos);
			// echo $turnos;
			// print_r($turnos);
		}

		public function buscar($pageNum = null) {
			if (usuarioLoggedIn()) {
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
		      
					$imagenes_perfil = $this->usuario->getImageById($_SESSION['user_id']);
					$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);

					$allLikes = $this->usuario->readAllLiked($_SESSION['user_id']);
					$likes = [];

					foreach($allLikes as $like) {
						array_push($likes, $like->id_publicacion);
					}

					$data = [
						'termino' => $busqueda,
						'resultados' => $resultados,
						'allLikes' => $likes,
						'imagenes_perfil' => $imagenes_perfil,
						'sidebar' => $sidebar,
						'controller' => strtolower(get_called_class()),
						'page' => __FUNCTION__
					];

					$this->view('usuario/buscar', $data);

				}		
			}	else {
				redirect('pages/login');
			}

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

		// public function turnos($id_profesional = null, $dia=null) {

			// $turnos = $this->usuario->getTurnosByUser($id_profesional,$dia);

			// convertir PDO objecto to array & send to frontend page
			// echo json_encode($turnos);
			// echo $turnos;
			// print_r($turnos);
		// }

		public function like($id_public = null, $like = 1) {

			if (usuarioLoggedIn() || usuariopLoggedIn() ) {

				header('Content-Type: application/json, charset=UTF-8');

				$json = json_decode(file_get_contents('php://input'));
				$id_public = $json->{'id_publicacion'};
				$user_id = $_SESSION['user_id'];

				$publicLiked = $this->usuario->readLikedByUser($user_id, $id_public);

				if ($publicLiked) {

					$decreased = $this->usuario->decreasePublicLikes($id_public, $like);

					if ($decreased) {
						$this->usuario->deleteLikedByUser($user_id, $id_public);
						$updatedLikes = $this->usuario->readNumLikes($id_public);
						$data = [
							'likes' => $updatedLikes,
							'icon_color' => 'text-red'
						];
						echo json_encode($data);
					}

				} else {

					$increased = $this->usuario->increasePublicLikes($id_public, $like);

					if ($increased) {
						$this->usuario->createLikedByUser($user_id, $id_public, $like);
						$updatedLikes = $this->usuario->readNumLikes($id_public);
						$data = [
							'likes' => $updatedLikes,
							'icon_color' => 'text-red'
						];
						echo json_encode($data);
					}
				}



			} else {
				redirect('pages/login');
			}
		}



	}
?>