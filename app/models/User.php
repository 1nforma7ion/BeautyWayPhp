<?php 
	class User {
		private $db;
 
		public function __construct() {
			$this->db = new Database;
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

		public function getMensajesById($user_id) {
			$this->db->query('SELECT *, m.id AS mensaje_id FROM mensajes m INNER JOIN usuarios u ON m.enviado_por = u.id WHERE m.recibido_por = :user_id ORDER BY m.fecha DESC');
			$this->db->bind(':user_id', $user_id);

			$profesiones = $this->db->getSet();
			return $profesiones;
		}

		public function createMensaje($recibido_por, $enviado_por, $mensaje) {
			$this->db->query('INSERT INTO mensajes (recibido_por, enviado_por, mensaje) VALUES (:recibido_por, :enviado_por, :mensaje)');
			$this->db->bind(':recibido_por', $recibido_por);
			$this->db->bind(':enviado_por', $enviado_por);
			$this->db->bind(':mensaje', $mensaje);
			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}

		}

// INICIO detalles
		public function getDiasByUser($id_profesional) {
			$this->db->query('SELECT dia FROM usuarios_horarios 
				WHERE id_usuario = :id_profesional 
				AND STR_TO_DATE(dia,"%d-%m-%Y") >= CURDATE() 
				AND estado =1 
				GROUP BY dia ASC');
			$this->db->bind(':id_profesional', $id_profesional);
			$dias = $this->db->getSet();
			return $dias;
		}

		public function getTurnosByUser($id_profesional = null, $dia = null) {
			$this->db->query('SELECT hora_fin, hora_inicio 
				FROM usuarios_horarios 
				WHERE id_usuario = :id_profesional 
				AND dia = :dia 
				AND STR_TO_DATE(hora_inicio, "%H") > NOW()
				AND estado = 1');
			$this->db->bind(':id_profesional', $id_profesional);
			$this->db->bind(':dia', $dia);
			$dias = $this->db->getSet();
			return $dias;
		}

		public function updateTurnosByUser($id_profesional, $dia, $hora_inicio, $estado) {
			$this->db->query('UPDATE usuarios_horarios SET estado = :estado 
				WHERE id_usuario = :id_profesional AND dia = :dia AND hora_inicio = :hora_inicio');
			$this->db->bind(':id_profesional', $id_profesional);
			$this->db->bind(':dia', $dia);
			$this->db->bind(':hora_inicio', $hora_inicio);
			$this->db->bind(':estado', $estado);
			$updated = $this->db->execute();

			if ($updated) {
				return true;
			} else {
				return false;
			}
		}

		public function getPublicById($id_public) {
			$this->db->query('SELECT *, p.id_usuario AS id_profesional, p.id AS id_public FROM publicaciones p 
				INNER JOIN usuarios u ON p.id_usuario = u.id 
				INNER JOIN perfiles pe ON p.id_usuario = pe.id_usuario 
				INNER JOIN zonas z ON z.id = u.id_zona_trabajo 
				WHERE p.id = :id_public');
			$this->db->bind(':id_public', $id_public);

			$publicacion = $this->db->getSingle();
			return $publicacion;
		}

		public function createReserva($user_id, $id_profesional, $id_public, $servicio, $dia, $hora_inicio, $hora_fin, $status) {
			$this->db->query('INSERT INTO reservas (id_usuario, id_profesional, id_publicacion, servicio, dia, hora_inicio, hora_fin, status) 
				VALUES (:user_id, :id_profesional, :id_public, :servicio, :dia, :hora_inicio, :hora_fin, :status)');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':id_profesional', $id_profesional);
			$this->db->bind(':id_public', $id_public);
			$this->db->bind(':servicio', $servicio);
			$this->db->bind(':dia', $dia);
			$this->db->bind(':hora_inicio', $hora_inicio);
			$this->db->bind(':hora_fin', $hora_fin);
			$this->db->bind(':status', $status);
			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}


// FIN detalles


// INICIO perfil


		public function createImagenPerfil($user_id, $imagen) {
			$this->db->query('INSERT INTO perfiles (id_usuario, imagen_usuario) VALUES (:user_id, :imagen)');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':imagen', $imagen);
			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}

		public function updatePassword($user_id,$password) {
      $this->db->query('UPDATE usuarios SET contrasenia = :password  WHERE id = :user_id');
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':password', $password);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

		public function updateImagenPerfil($user_id,$imagen) {
      $this->db->query('UPDATE perfiles SET imagen_usuario = :imagen  WHERE id_usuario = :user_id');
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':imagen', $imagen);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

		public function updatePerfil($user_id,$nombre,$apellido,$telefono) {
      $this->db->query('UPDATE usuarios SET 
      	nombre = :nombre,
      	apellido = :apellido,
      	telefono = :telefono
      	WHERE id = :user_id');
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':nombre', $nombre);
      $this->db->bind(':apellido', $apellido);
      $this->db->bind(':telefono', $telefono);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

// FIN perfil

		public function getReservasByUser($user_id) {
			$this->db->query('SELECT *, r.id_profesional AS id_prof, r.id AS id_reserva 
				FROM reservas r 
				INNER JOIN usuarios u ON u.id = r.id_profesional
				WHERE r.id_usuario = :user_id 
				ORDER BY r.dia ASC');
			$this->db->bind(':user_id', $user_id);

			$reservas = $this->db->getSet();
			return $reservas;
		}

		public function updateReservaStatus($id_reserva, $status) {
      $this->db->query('UPDATE reservas SET status = :status  WHERE id = :id_reserva');
      $this->db->bind(':id_reserva', $id_reserva);
      $this->db->bind(':status', $status);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }



	}
?>
