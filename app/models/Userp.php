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

		public function getServiciosByUser($user_id, $id_profesion) {
			$this->db->query('SELECT id,servicio FROM usuarios_servicios WHERE id_profesion = :id_profesion AND id_usuario = :user_id');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':id_profesion', $id_profesion);

			$services = $this->db->getSet();
			return $services;
		}

		public function getTurnosByUser($user_id) {
			$this->db->query('SELECT * FROM usuarios_turnos WHERE id_usuario = :user_id ORDER BY dia');
			$this->db->bind(':user_id', $user_id);

			$turnos = $this->db->getSet();
			return $turnos;
		}

		public function getHorarios($user_id) {
			$this->db->query('SELECT * FROM usuarios_horarios WHERE id_usuario = :user_id ORDER BY dia');
			$this->db->bind(':user_id', $user_id);

			$horarios = $this->db->getSet();
			return $horarios;
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

		public function agregarHorario($user_id, $dia_nombre, $dia, $estado) {
			$this->db->query('INSERT INTO usuarios_horarios (id_usuario, dia_nombre, dia, estado) VALUES (:user_id, :dia_nombre, :cierre, :estado)');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':dia_nombre', $dia_nombre);
			$this->db->bind(':dia', $dia);
			$this->db->bind(':estado', $estado);

			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}

		public function agregarTurno($user_id, $dia_nombre, $dia, $apertura, $cierre, $estado = 1) {
			$this->db->query('INSERT INTO usuarios_turnos (id_usuario, dia_nombre, dia, apertura, cierre, estado) VALUES (:user_id, :dia_nombre, :dia, :apertura, :cierre, :estado)');
			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':dia_nombre', $dia_nombre);
			$this->db->bind(':dia', $dia);
			$this->db->bind(':apertura', $apertura);
			$this->db->bind(':cierre', $cierre);
			$this->db->bind(':estado', $estado);

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

		public function getReservasByUser($user) {
			$this->db->query('SELECT * FROM publicaciones WHERE id_usuario = :user');
			$this->db->bind(':user', $user);
			$reservas = $this->db->getSet();
			return $reservas;
		}



		public function register($rol,$tipo,$doc,$nombre,$apellido,$calle,$altura,$piso,$depto,$barrio,$localidad,$telefono,$email,$pass,$comercial,$profesion,$modalidad,$zona) {
			$this->db->query("INSERT INTO usuarios (rol_id, tipo_documento, num_documento, nombre, apellido, nombre_comercial, id_profesion, id_zona_trabajo, modalidad, calle, altura, piso, depto, barrio, localidad, telefono, email, contrasenia) 
				VALUES (:rol,:tipo,:doc,:nombre,:apellido,:comercial,:profesion,:zona,:modalidad,:calle,:altura,:piso,:depto,:barrio,:localidad,:telefono,:email,:pass)");
			$this->db->bind(':rol',$rol);
			$this->db->bind(':tipo',$tipo);
			$this->db->bind(':doc',$doc);
			$this->db->bind(':nombre',$nombre);
			$this->db->bind(':apellido',$apellido);
			$this->db->bind(':calle',$calle);
			$this->db->bind(':altura',$altura);
			$this->db->bind(':piso',$piso);
			$this->db->bind(':depto',$depto);
			$this->db->bind(':barrio',$barrio);
			$this->db->bind(':localidad',$localidad);
			$this->db->bind(':telefono',$telefono);
			$this->db->bind(':email',$email);
			$this->db->bind(':pass',$pass);
			$this->db->bind(':comercial',$comercial);
			$this->db->bind(':profesion',$profesion);
			$this->db->bind(':modalidad',$modalidad);
			$this->db->bind(':zona',$zona);


			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}


		public function savePublic($user_id, $descripcion, $urlImagen, $zona, $estado, $descuento, $vigencia) {
			$this->db->query("INSERT INTO publicaciones (id_usuario, descripcion, imagen, zona, estado, descuento, vigencia_dias) 
				VALUES (:user_id, :descripcion, :urlImagen, :zona, :estado, :descuento, :vigencia)");
			$this->db->bind(':user_id',$user_id);
			$this->db->bind(':descripcion',$descripcion);
			$this->db->bind(':urlImagen',$urlImagen);
			$this->db->bind(':zona',$zona);
			$this->db->bind(':estado',$estado);
			$this->db->bind(':descuento',$descuento);
			$this->db->bind(':vigencia',$vigencia);
			$creado = $this->db->execute();

			if ($creado) {
				return true;
			} else {
				return false;
			}
		}





	}
?>
