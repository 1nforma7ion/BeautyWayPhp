<?php 
	class Administrador {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getMenuByRole($user_rol_id, $status = 1) {
			$this->db->query('SELECT * FROM sidebar WHERE user_rol_id = :user_rol_id AND menu_item_status = :status ORDER BY menu_item_order');
			$this->db->bind(':user_rol_id', $user_rol_id);
			$this->db->bind(':status', $status);
			$menu = $this->db->getSet();
			return $menu;
		}

		public function getMenuSidebar() {
			$this->db->query('SELECT *, s.id as item_id, r.id as rol_id FROM sidebar s INNER JOIN roles r ON s.user_rol_id = r.id');
			$menu = $this->db->getSet();
			return $menu;
		}

		public function getProfesiones() {
			$this->db->query('SELECT * FROM profesiones');
			$profesiones = $this->db->getSet();
			return $profesiones;
		}

		public function getServiciosByProfesion($id_profesion) {
			$this->db->query('SELECT * FROM servicios WHERE id_profesion = :id_profesion ');
			$this->db->bind(':id_profesion', $id_profesion);

			$servicios = $this->db->getSet();
			return $servicios;
		}



		public function getRoles() {
			$this->db->query('SELECT * FROM roles');
			$roles = $this->db->getSet();
			return $roles;
		}

		public function getUsuarios() {
			$this->db->query('SELECT *, u.id as user_id, r.id as id_rol_table FROM usuarios u INNER JOIN roles r ON u.rol_id = r.id');
			$roles = $this->db->getSet();
			return $roles;
		}


		public function addServicio($id_profesion, $servicio,$estado) {
			$this->db->query('INSERT INTO servicios (id_profesion, servicio, estado)	VALUES (:id_profesion, :servicio, :estado)');
			$this->db->bind(':id_profesion', $id_profesion);
			$this->db->bind(':servicio', $servicio);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateServicio($servicio_id,$servicio,$estado) {
			$this->db->query('UPDATE servicios SET 
				servicio = :servicio,  
				estado = :estado
				WHERE id = :servicio_id ');

			$this->db->bind(':servicio_id', $servicio_id);
			$this->db->bind(':servicio', $servicio);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}


		public function addProfesion($profesion,$estado) {
			$this->db->query('INSERT INTO profesiones (profesion, estado)	VALUES (:profesion, :estado)');
			$this->db->bind(':profesion', $profesion);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateProfesion($profesion_id,$profesion,$estado) {
			$this->db->query('UPDATE profesiones SET 
				profesion = :profesion,  
				estado = :estado
				WHERE id = :profesion_id ');

			$this->db->bind(':profesion_id', $profesion_id);
			$this->db->bind(':profesion', $profesion);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function deleteProfesion($id, $status = 0){
			$this->db->query('UPDATE profesiones SET estado = :status  WHERE id = :id ');
			$this->db->bind(':id', $id);
			$this->db->bind(':status', $status);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function addMenuItem($rol_id,$url,$text,$icon,$status,$order) {
			$this->db->query('INSERT INTO sidebar (user_rol_id, menu_item_url, menu_item_text, menu_item_icon, menu_item_status, menu_item_order) 
				VALUES (:rol_id, :url, :text, :icon, :status, :order) ');
			$this->db->bind(':rol_id', $rol_id);
			$this->db->bind(':url', $url);
			$this->db->bind(':text', $text);
			$this->db->bind(':icon', $icon);
			$this->db->bind(':status', $status);
			$this->db->bind(':order', $order);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateMenuItem($item_id,$rol_id,$url,$text,$icon,$status,$order) {
			$this->db->query('UPDATE sidebar SET 
				user_rol_id = :rol_id,  
				menu_item_url = :url, 
				menu_item_text = :text,
				menu_item_icon = :icon,
				menu_item_status = :status,
				menu_item_order = :order
				WHERE id = :item_id ');

			$this->db->bind(':item_id', $item_id);
			$this->db->bind(':rol_id', $rol_id);
			$this->db->bind(':url', $url);
			$this->db->bind(':text', $text);
			$this->db->bind(':icon', $icon);
			$this->db->bind(':status', $status);
			$this->db->bind(':order', $order);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}


		public function deleteMenuItem($id){
			$this->db->query('DELETE FROM sidebar WHERE id = :id' );
			$this->db->bind(':id', $id);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}



		public function updateUsuario($user_id,$rol_id,$telefono,$nombre,$apellido,$email,$estado) {
			$this->db->query('UPDATE usuarios SET 
				rol_id = :rol_id,  
				telefono = :telefono, 
				nombre = :nombre,
				apellido = :apellido,
				email = :email,
				estado = :estado
				WHERE id = :user_id ');

			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':rol_id', $rol_id);
			$this->db->bind(':telefono', $telefono);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':apellido', $apellido);
			$this->db->bind(':email', $email);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateProfesional($user_id,$rol_id,$nombre_comercial,$nombre,$apellido,$email,$estado) {
			$this->db->query('UPDATE usuarios SET 
				rol_id = :rol_id,  
				nombre_comercial = :nombre_comercial, 
				nombre = :nombre,
				apellido = :apellido,
				email = :email,
				estado = :estado
				WHERE id = :user_id ');

			$this->db->bind(':user_id', $user_id);
			$this->db->bind(':rol_id', $rol_id);
			$this->db->bind(':nombre_comercial', $nombre_comercial);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':apellido', $apellido);
			$this->db->bind(':email', $email);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function deleteUsuario($id, $status = 0){
			$this->db->query('UPDATE usuarios SET estado = :status  WHERE id = :id ');
			$this->db->bind(':id', $id);
			$this->db->bind(':status', $status);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}



// INICIO reportes

		public function readAllUsers() {
			$this->db->query('SELECT COUNT(u.rol_id) as total, r.rol FROM usuarios u INNER JOIN roles r ON u.rol_id = r.id GROUP BY rol_id');
			$usuarios = $this->db->getSet();
			return $usuarios;
		}

		public function readServiciosContratados($status_reserva, $num_limit) {
			$this->db->query('SELECT COUNT(servicio) as total, servicio from reservas WHERE status = :status_reserva GROUP BY servicio ORDER BY total DESC LIMIT :num_limit');
			$this->db->bind(':status_reserva', $status_reserva);
			$this->db->bind(':num_limit', $num_limit);

			$contratados = $this->db->getSet();
			return $contratados;
		}

		public function readLikesServicios($num_limit) {
			$this->db->query('SELECT p.servicio, p.me_gusta, u.nombre_comercial from publicaciones p INNER JOIN usuarios u ON p.id_usuario = u.id ORDER BY me_gusta DESC LIMIT :num_limit');
			$this->db->bind(':num_limit', $num_limit);

			$likes_serv = $this->db->getSet();
			return $likes_serv;
		}


		public function readServiciosZona($status_reserva) {
			$this->db->query('SELECT COUNT(p.zona_public) AS total, p.zona_public FROM reservas r INNER JOIN publicaciones p ON r.id_publicacion = p.id WHERE r.status = :status_reserva GROUP BY p.zona_public');
			$this->db->bind(':status_reserva', $status_reserva);

			$servicios_zona = $this->db->getSet();
			return $servicios_zona;
		}

		public function readReservasByModalidad($status_reserva) {
			$this->db->query('SELECT COUNT(modalidad) AS total, modalidad FROM reservas WHERE STATUS = :status_reserva GROUP BY modalidad ORDER BY total');
			$this->db->bind(':status_reserva', $status_reserva);

			$modalidades = $this->db->getSet();
			return $modalidades;
		}



// FIN reportes



// INICIO condiciones



		public function readCondiciones($status=1) {
			$this->db->query('SELECT * FROM condiciones WHERE estado = :status ORDER BY id');
			$this->db->bind(':status', $status);

			$condiciones = $this->db->getSet();
			return $condiciones;
		}

		public function createCondicion($numero, $titulo, $descripcion, $estado) {
			$this->db->query('INSERT INTO condiciones (numero, titulo, descripcion, estado)	VALUES (:numero, :titulo, :descripcion, :estado)');
			$this->db->bind(':numero', $numero);
			$this->db->bind(':titulo', $titulo);
			$this->db->bind(':descripcion', $descripcion);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateCondicion($condicion_id, $numero, $titulo, $descripcion, $estado) {
			$this->db->query('UPDATE condiciones SET 
				numero = :numero,  
				titulo = :titulo,
				descripcion = :descripcion,
				estado = :estado
				WHERE id = :condicion_id ');

			$this->db->bind(':condicion_id', $condicion_id);
			$this->db->bind(':numero', $numero);
			$this->db->bind(':titulo', $titulo);
			$this->db->bind(':descripcion', $descripcion);
			$this->db->bind(':estado', $estado);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}


// FIN condiciones



	}
?>