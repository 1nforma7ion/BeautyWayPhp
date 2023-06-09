<?php 
	class Page {
		private $db;
 
		public function __construct() {
			$this->db = new Database;
		}

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




		public function getComic($name) {
			$this->db->query('SELECT * FROM proyectos WHERE nombre = :name');
			$this->db->bind(':name',$name);
			$comic = $this->db->getSingle();
			return $comic;
		}

		public function getChapters($id,$estado1) {
			$this->db->query("SELECT * FROM capitulos WHERE proyecto_id = :id AND estado = :estado1 ORDER BY created_at DESC");
			$this->db->bind(':id',$id);
			$this->db->bind(':estado1',$estado1);
			$chapters = $this->db->getSet();
			return $chapters;
		}

		public function getUpcoming($id,$estado2) {
			$this->db->query("SELECT * FROM capitulos WHERE proyecto_id = :id AND estado = :estado2");
			$this->db->bind(':id',$id);
			$this->db->bind(':estado2',$estado2);
			$upcoming = $this->db->getSet();
			return $upcoming;
		}

		public function getDataChapter($id,$num) {
			$this->db->query("SELECT * FROM capitulos WHERE proyecto_id = :id AND cap_num = :num");
			$this->db->bind(':id',$id);
			$this->db->bind(':num',$num);
			$chapter = $this->db->getSingle();
			return $chapter;
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

		public function getAuthors() {
			$this->db->query('SELECT * FROM autores');
			$autores = $this->db->getSet();
			return $autores;
		}




	}
?>
