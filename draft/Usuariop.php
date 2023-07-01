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
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
				$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
				// $turnos = $this->usuariop->getTurnosByUser($_SESSION['user_id']);

				$data = [
					'imagenes_perfil' => $imagenes_perfil,
					// 'turnos' => $turnos,
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


				if (isset($_POST['add_horario'])) {
					$dia = $_POST['dia'];
					$estado = $_POST['estado'];
					$dia_nombre = $_POST['dia_nombre'];

					$added = $this->usuariop->agregarHorario($_SESSION['user_id'], $dia_nombre, $dia, $estado);
					if ($added) {
						redirect('usuariop/perfil');
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
				$modalidades = $this->page->getModalidades();
				$zonas = $this->page->getZonas();
				$localidades = $this->page->getLocalidades();
				
				$diasHabiles = [];
				$horarios = $this->usuariop->getHorarios($_SESSION['user_id']);
				foreach($horarios as $row) {
					array_push($diasHabiles, $row->dia);
				}

				$listaProfesiones = $this->admin->getProfesiones();
				$profesiones = $this->usuariop->getProfesionesByUser($_SESSION['user_id']);
				$sidebar = $this->admin->getMenuByRole($_SESSION['user_rol_id']);
				$dias = [ 1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];

				$data = [
					'perfil' => $perfil,
					'imagenes_perfil' => $imagenes_perfil,
					'zonas' => $zonas,
					'localidades' => $localidades,
					'modalidades' => $modalidades,
					'diasHabiles' => $diasHabiles,
					'dias' => $dias,
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