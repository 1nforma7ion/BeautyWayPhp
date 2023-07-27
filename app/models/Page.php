<?php 
	class Page {
		private $db;
 
		public function __construct() {
			$this->db = new Database;
		}

		public function getAllPublicaciones() {
			$this->db->query('SELECT *, p.id_usuario AS id_profesional, p.id AS id_public FROM publicaciones p 
				INNER JOIN usuarios u ON p.id_usuario = u.id 
				INNER JOIN perfiles pe ON p.id_usuario = pe.id_usuario 
				INNER JOIN zonas z ON z.id = u.id_zona_trabajo 
				WHERE p.estado = 1 ORDER BY p.creado DESC');
			$publicaciones = $this->db->getSet();
			return $publicaciones;
		}

		public function getAllDescuentos() {
			$this->db->query('SELECT * FROM publicaciones p 
				INNER JOIN usuarios u ON p.id_usuario = u.id 
				INNER JOIN perfiles pe ON p.id_usuario = pe.id_usuario 
				INNER JOIN zonas z ON z.id = u.id_zona_trabajo 
				WHERE p.estado = 1 ORDER BY p.descuento DESC LIMIT 3');
			$publicaciones = $this->db->getSet();
			return $publicaciones;
		}


		public function findEmail($email) {
			$this->db->query('SELECT *, u.estado AS user_estado, u.id AS user_id, r.id AS rol_id FROM usuarios u 
				INNER JOIN roles r ON r.id = u.rol_id 
				INNER JOIN zonas z ON z.id = u.id_zona_trabajo 
				WHERE u.email = :email');
			$this->db->bind(':email', $email);
			$user = $this->db->getSingle();

			if ($user) {
				return $user;
			} else {
				return false;
			}
		}

		public function findDocumento($num_documento) {
			$this->db->query('SELECT * FROM usuarios WHERE num_documento = :num_documento');
			$this->db->bind(':num_documento', $num_documento);
			$doc = $this->db->getSingle();

			if ($doc) {
				return $doc;
			} else {
				return false;
			}
		}

		public function saveToken($email, $token) {
			$this->db->query('INSERT INTO usuarios_token (email, token) VALUES (:email, :token)');
			$this->db->bind(':email', $email);
			$this->db->bind(':token', $token);
			
			if($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function getUserByToken($token) {
			$this->db->query('SELECT email FROM usuarios_token WHERE token = :token');
			$this->db->bind(':token', $token);
			$user = $this->db->getSingle();

			if ($user) {
				return $user->email;
			} else {
				return false;
			}
		}

		public function updatePassBytoken($email,$password) {
      $this->db->query('UPDATE usuarios SET contrasenia = :password  WHERE email = :email');
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

		public function deleteToken($email) {
			$this->db->query('DELETE FROM usuarios_token WHERE email = :email');
			$this->db->bind(':email', $email);
			
			if($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}



		public function getProfesiones() {
			$this->db->query('SELECT * FROM profesiones');
			$profesiones = $this->db->getSet();
			return $profesiones;
		}

		public function getZonas() {
			$this->db->query('SELECT * FROM zonas');
			$zonas = $this->db->getSet();
			return $zonas;
		}


		public function getLocalidades() {
			$this->db->query('SELECT * FROM localidades');
			$localidades = $this->db->getSet();
			return $localidades;
		}


		public function getModalidades() {
			$this->db->query('SELECT * FROM modalidades');
			$modalidades = $this->db->getSet();
			return $modalidades;
		}

		public function getTipoDocs() {
			$this->db->query('SELECT * FROM tipo_docs');
			$tipoDocs = $this->db->getSet();
			return $tipoDocs;
		}



		public function getFirstService($id_profesion) {
			$this->db->query('SELECT servicio FROM servicios WHERE id_profesion = :id_profesion AND estado = 1 LIMIT 1');
			$this->db->bind(':id_profesion', $id_profesion);
			
			$servicio = $this->db->getSingle();
			return $servicio->servicio;
		}

		public function getLastUserId() {
			$this->db->query('SELECT MAX(id) AS user_id FROM usuarios');
			
			$userId = $this->db->getSingle();

			if ($userId) {
				return $userId->user_id;
			} else {
				return false;
			}
		}

		public function register($rol,$tipo,$doc,$nombre,$apellido,$calle,$altura,$piso,$depto,$barrio,$localidad,$telefono,$email,$pass,$comercial,$profesion,$modalidad,$zona,$estado) {

			try {
				$this->db->beginTransaction();   

					$this->db->query("INSERT INTO usuarios (rol_id, tipo_documento, num_documento, nombre, apellido, nombre_comercial, id_zona_trabajo, modalidad, calle, altura, piso, depto, barrio, localidad, telefono, email, contrasenia, estado) 
						VALUES (:rol,:tipo,:doc,:nombre,:apellido,:comercial,:zona,:modalidad,:calle,:altura,:piso,:depto,:barrio,:localidad,:telefono,:email,:pass, :estado)");
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
					$this->db->bind(':modalidad',$modalidad);
					$this->db->bind(':zona',$zona);
					$this->db->bind(':estado',$estado);
					// $this->db->execute();
					
						if($this->db->execute()) {
								$id_usuario = $this->getLastUserId();

								if ($id_usuario > 0) {
									foreach ($profesion as $id_profesion) {
										$servicio = $this->getFirstService($id_profesion);

										$this->db->query('INSERT INTO usuarios_servicios (id_usuario, id_profesion, servicio) VALUES (:id_usuario, :id_profesion, :servicio)');
										$this->db->bind(':servicio', $servicio);
										$this->db->bind(':id_profesion', $id_profesion);
										$this->db->bind(':id_usuario', $id_usuario);
										$this->db->execute();
										
									}
						
								
									$this->db->commit();
									return true;
								}

						} 
									// $this->db->commit();


			} catch (Exception $e) {
				$this->db->rollBack();
    		return false;
			}

		}




	}
?>
