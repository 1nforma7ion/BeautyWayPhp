<?php 
	class User {
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

		public function getProfesiones() {
			$this->db->query('SELECT * FROM profesiones');
			$projects = $this->db->getSet();
			return $projects;
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



		public function getAuthors() {
			$this->db->query('SELECT * FROM autores');
			$autores = $this->db->getSet();
			return $autores;
		}




	}
?>
