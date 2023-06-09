<?php 
	class Userp {
		private $db;
 
		public function __construct() {
			$this->db = new Database;
		}


		// public function getServiciosByUser($id_profesion, $status = 1) {
		// 	$this->db->query('SELECT * FROM servicios  WHERE id_profesion = :id_profesion AND estado = :status');
		// 	$this->db->bind(':id_profesion', $id_profesion);
		// 	$this->db->bind(':status', $status);

		// 	$servicios = $this->db->getSet();

		// 	if ($servicios) {
		// 		return $servicios;
		// 	} else {
		// 		return false;
		// 	}
		// }

		public function findEmail($email) {
			$this->db->query('SELECT *, u.id AS user_id FROM usuarios u INNER JOIN roles r ON r.id = u.rol_id WHERE email = :email');
			$this->db->bind(':email', $email);
			$user = $this->db->getSingle();

			if ($user) {
				return $user;
			} else {
				return false;
			}
		}

		public function getZonas() {
			$this->db->query('SELECT * FROM zonas');
			$zonas = $this->db->getSet();
			return $zonas;
		}

		public function getProfesiones() {
			$this->db->query('SELECT * FROM profesiones');
			$projects = $this->db->getSet();
			return $projects;
		}

		public function getUserById($id) {
			$this->db->query('SELECT *, u.id as user_id FROM usuarios u INNER JOIN zonas z ON u.id_zona_trabajo = z.id	WHERE u.id = :id');
			$this->db->bind(':id', $id);

			$perfil = $this->db->getSingle();
			return $perfil;
		}

		public function getImageById($id) {
			$this->db->query('SELECT * FROM perfiles WHERE id_usuario = :id');
			$this->db->bind(':id', $id);
			$perfil = $this->db->getSingle();
			return $perfil;
		}

		public function createImagenPerfil($user_id, $imagen) {
			$this->db->query('INSERT INTO perfiles (id_usuario, imagen_comercial) VALUES (:user_id, :imagen)');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':imagen', $imagen);

			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}

		public function getProfesionById($id) {
			$this->db->query('SELECT id, profesion FROM profesiones WHERE id = :id');
			$this->db->bind(':id', $id);

			$profesion = $this->db->getSingle();
			return $profesion;
		}

		public function getTodosServiciosById($id_profesion) {
			$this->db->query('SELECT * FROM servicios WHERE id_profesion = :id_profesion');
			$this->db->bind(':id_profesion', $id_profesion);

			$todosServicios = $this->db->getSet();
			return $todosServicios;
		}

		public function getHoras() {
			$this->db->query('SELECT * FROM hora_turnos');
			$horas = $this->db->getSet();
			return $horas;
		}

		public function getPublicacionesByUser($user_id) {
			$this->db->query('SELECT *, p.id as id_public FROM publicaciones p 
				INNER JOIN usuarios u ON p.id_usuario = u.id 
				INNER JOIN perfiles pe ON pe.id_usuario = u.id
				WHERE p.id_usuario = :user_id ORDER BY p.creado DESC');
			$this->db->bind(':user_id', $user_id);

			$publicaciones = $this->db->getSet();
			return $publicaciones;
		}

		public function getServiciosByUser($user_id, $id_profesion) {
			$this->db->query('SELECT id,servicio FROM usuarios_servicios WHERE id_profesion = :id_profesion AND id_usuario = :user_id');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':id_profesion', $id_profesion);

			$services = $this->db->getSet();
			return $services;
		}

		// public function getTurnosByUser($user_id) {
		// 	$this->db->query('SELECT * FROM usuarios_turnos WHERE id_usuario = :user_id ORDER BY dia');
		// 	$this->db->bind(':user_id', $user_id);

		// 	$turnos = $this->db->getSet();
		// 	return $turnos;
		// }



		public function activarServicio($user_id, $id_profesion, $servicio) {
			$this->db->query('INSERT INTO usuarios_servicios (id_usuario, id_profesion, servicio) VALUES (:user_id, :id_profesion, :servicio)');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':id_profesion', $id_profesion);
			$this->db->bind(':servicio', $servicio);

			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}

		public function desactivarServicio($id){
			$this->db->query('DELETE FROM usuarios_servicios WHERE id = :id' );
			$this->db->bind(':id', $id);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function agregarProfesion($user_id, $id_profesion, $servicio = 'default') {
			$this->db->query('INSERT INTO usuarios_servicios (id_usuario, id_profesion, servicio) VALUES (:user_id, :id_profesion, :servicio)');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':id_profesion', $id_profesion);
			$this->db->bind(':servicio', $servicio);

			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}



// INICIO HORARIOS - TURNOS
		public function getHorarios($user_id) {
			$this->db->query('SELECT * FROM usuarios_horarios WHERE id_usuario = :user_id ORDER BY dia ASC');
			$this->db->bind(':user_id', $user_id);

			$horarios = $this->db->getSet();
			return $horarios;
		}

		public function updateHorario($id, $hora_inicio, $hora_fin) {

			$this->db->query('UPDATE usuarios_horarios SET hora_inicio = :hora_inicio, hora_fin = :hora_fin WHERE id = :id');
			$this->db->bind(':id', $id);
			$this->db->bind(':hora_inicio', $hora_inicio);
			$this->db->bind(':hora_fin', $hora_fin);
			

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function agregarHorario($result) {
      $errors = [];

      foreach($result as $row) {

      	for($i = 0; $i < count($row); $i++) {
					$this->db->query('INSERT INTO usuarios_horarios (id_usuario, dia, hora_inicio, hora_fin) VALUES (:user_id, :dia, :hora_inicio, :hora_fin)');
					$this->db->bind(':user_id', $row[$i]['user_id']);
					$this->db->bind(':dia', $row[$i]['dia']);
					$this->db->bind(':hora_inicio', $row[$i]['hora_inicio']);
					$this->db->bind(':hora_fin', $row[$i]['hora_fin']);

				  if(!$this->db->execute()) {
	          array_push($errors, "Error on INSERT INTO " . $row[$i]);
	        } 
      	}

			}

			if (count($errors) == 0) {
				return true;
			} else {
				return false;
			}
		}

		// public function agregarHorario($horarios) {
    //   $errors = [];

    //   foreach($horarios as $row) {
		// 		$this->db->query('INSERT INTO usuarios_horarios (id_usuario, dia, hora_inicio, hora_fin) VALUES (:user_id, :dia, :hora_inicio, :hora_fin)');
		// 		$this->db->bind(':user_id', $row['user_id']);
		// 		$this->db->bind(':dia', $row['dia']);
		// 		$this->db->bind(':hora_inicio', $row['hora_inicio']);
		// 		$this->db->bind(':hora_fin', $row['hora_fin']);

		// 	  if(!$this->db->execute()) {
    //       array_push($errors, "Error when saving" . $row);
    //     } 
		// 	}

		// 	if (count($errors) == 0) {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// }

		// public function agregarTurno($user_id, $dia_nombre, $dia, $apertura, $cierre, $estado = 1) {
		// 	$this->db->query('INSERT INTO usuarios_turnos (id_usuario, dia_nombre, dia, apertura, cierre, estado) VALUES (:user_id, :dia_nombre, :dia, :apertura, :cierre, :estado)');
		// 	$this->db->bind(':user_id', $user_id);
		// 	$this->db->bind(':dia_nombre', $dia_nombre);
		// 	$this->db->bind(':dia', $dia);
		// 	$this->db->bind(':apertura', $apertura);
		// 	$this->db->bind(':cierre', $cierre);
		// 	$this->db->bind(':estado', $estado);

		// 	$creado = $this->db->execute();

		// 	if ($creado) {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// }

		public function eliminarHorario($id) {
			$this->db->query('DELETE FROM usuarios_horarios WHERE id = :id');
			$this->db->bind(':id', $id);
			$deleted = $this->db->execute();

			if ($deleted) {
				return true;
			} else {
				return false;
			}
		}



		public function getProfesionesByUser($user_id) {
			$this->db->query('SELECT * FROM usuarios_servicios u INNER JOIN profesiones p ON u.id_profesion = p.id WHERE u.id_usuario = :user_id GROUP BY p.id');
			$this->db->bind(':user_id', $user_id);

			$profesiones = $this->db->getSet();
			return $profesiones;
		}

		public function getReservasByUser($user) {
			$this->db->query('SELECT * FROM publicaciones WHERE id_usuario = :user');
			$this->db->bind(':user', $user);
			$reservas = $this->db->getSet();
			return $reservas;
		}



		public function savePublic($user_id, $descripcion, $urlImagen, $duracion, $servicio, $descuento) {
			$this->db->query("INSERT INTO publicaciones (id_usuario, descripcion, imagen, duracion, servicio, descuento) 
				VALUES (:user_id, :descripcion, :urlImagen, :duracion, :servicio, :descuento)");
			$this->db->bind(':user_id',$user_id);
			$this->db->bind(':descripcion',$descripcion);
			$this->db->bind(':urlImagen',$urlImagen);
			$this->db->bind(':duracion',$duracion);
			$this->db->bind(':servicio',$servicio);
			$this->db->bind(':descuento',$descuento);
			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}





	}
?>
