<?php 
	class Userp {
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


		public function getAuthors() {
			$this->db->query('SELECT * FROM autores');
			$autores = $this->db->getSet();
			return $autores;
		}




	}
?>
