<?php 
	class Userp {
		private $db;
 
		public function __construct() {
			$this->db = new Database;
		}

// INICIO index

		public function getPublicacionesByUser($user_id) {
			$this->db->query('SELECT *, p.id as id_public FROM publicaciones p 
				INNER JOIN usuarios u ON p.id_usuario = u.id 
				WHERE p.id_usuario = :user_id ORDER BY p.creado DESC');
			$this->db->bind(':user_id', $user_id);

			$publicaciones = $this->db->getSet();
			return $publicaciones;
		}
// FIN index

// INICIO Edit_profesion
		public function getProfesionById($id) {
			$this->db->query('SELECT id, profesion FROM profesiones WHERE id = :id');
			$this->db->bind(':id', $id);

			$profesion = $this->db->getSingle();
			return $profesion;
		}

		public function getServiciosByUser($user_id, $id_profesion) {
			$this->db->query('SELECT id,servicio FROM usuarios_servicios WHERE id_profesion = :id_profesion AND id_usuario = :user_id');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':id_profesion', $id_profesion);

			$services = $this->db->getSet();
			return $services;
		}

		public function getTodosServiciosById($id_profesion) {
			$this->db->query('SELECT * FROM servicios WHERE id_profesion = :id_profesion');
			$this->db->bind(':id_profesion', $id_profesion);

			$todosServicios = $this->db->getSet();
			return $todosServicios;
		}

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

// FIN Edit_profesion




// INICIO Edit_turnos
		public function getHoras() {
			$this->db->query('SELECT * FROM hora_turnos');
			$horas = $this->db->getSet();
			return $horas;
		}

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

// FIN Edit_turnos


// INICIO perfil
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

		public function getProfesionesByUser($user_id) {
			$this->db->query('SELECT * FROM usuarios_servicios u INNER JOIN profesiones p ON u.id_profesion = p.id WHERE u.id_usuario = :user_id GROUP BY p.id');
			$this->db->bind(':user_id', $user_id);

			$profesiones = $this->db->getSet();
			return $profesiones;
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
// FIN perfil


		public function getReservasByUser($user) {
			$this->db->query('SELECT * FROM publicaciones WHERE id_usuario = :user');
			$this->db->bind(':user', $user);
			$reservas = $this->db->getSet();
			return $reservas;
		}

// INICIO publicar

		public function savePublic($user_id, $descripcion, $urlImagen, $servicio, $descuento) {
			$this->db->query("INSERT INTO publicaciones (id_usuario, descripcion, imagen, servicio, descuento) 
				VALUES (:user_id, :descripcion, :urlImagen, :servicio, :descuento)");
			$this->db->bind(':user_id',$user_id);
			$this->db->bind(':descripcion',$descripcion);
			$this->db->bind(':urlImagen',$urlImagen);
			$this->db->bind(':servicio',$servicio);
			$this->db->bind(':descuento',$descuento);
			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}

// FIN publicar




	}
?>
