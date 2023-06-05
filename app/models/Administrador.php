<?php 
	class Administrador {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getProjects() {
			$this->db->query('SELECT * FROM proyectos');
			$projects = $this->db->getSet();
			return $projects;
		}

		public function getAllChapters() {
			$this->db->query('SELECT * FROM capitulos');
			$chapters = $this->db->getSet();
			return $chapters;
		}

		public function getAuthors() {
			$this->db->query('SELECT * FROM autores');
			$autores = $this->db->getSet();
			return $autores;
		}

		public function getUserProfile($email) {
			$this->db->query('SELECT * FROM usuarios WHERE email = :email');
			$this->db->bind(':email',$email);
			$autores = $this->db->getSingle();
			return $autores;
		}

		public function getUsers() {
			$this->db->query('SELECT * FROM usuarios');
			$autores = $this->db->getSet();
			return $autores;
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

		public function updateChapter($comic_id,$cap_num,$titulo,$subtitulo,$autor,$paginas,$formato,$precio,$estado,$sinopsis,$imgUrl){
			$this->db->query('UPDATE capitulos SET 
				titulo = :titulo, 
				subtitulo = :subtitulo, 
				autor = :autor, 
				paginas = :paginas,
				formato = :formato,
				precio = :precio,
				estado = :estado,
				sinopsis = :sinopsis,
				portada = :imgUrl  
				WHERE cap_num = :cap_num AND proyecto_id = :comic_id');

			$this->db->bind(':comic_id', $comic_id);
			$this->db->bind(':cap_num', $cap_num);
			$this->db->bind(':titulo', $titulo);
			$this->db->bind(':subtitulo', $subtitulo);
			$this->db->bind(':autor', $autor);
			$this->db->bind(':paginas', $paginas);
			$this->db->bind(':formato', $formato);
			$this->db->bind(':precio', $precio);
			$this->db->bind(':estado', $estado);
			$this->db->bind(':sinopsis', $sinopsis);
			$this->db->bind(':imgUrl', $imgUrl);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function updateComic($comic_id,$nombre,$genero,$descripcion,$autor,$formato,$estado,$imgUrl){
			$this->db->query('UPDATE proyectos SET 
				nombre = :nombre, 
				genero = :genero, 
				descripcion = :descripcion,
				autor = :autor, 
				formato = :formato,
				estado = :estado,
				portada = :imgUrl  
				WHERE id = :comic_id');

			$this->db->bind(':comic_id', $comic_id);
			$this->db->bind(':nombre', $nombre);
			$this->db->bind(':genero', $genero);
			$this->db->bind(':descripcion', $descripcion);
			$this->db->bind(':autor', $autor);
			$this->db->bind(':formato', $formato);
			$this->db->bind(':estado', $estado);
			$this->db->bind(':imgUrl', $imgUrl);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function getChapterNum($id) {
			$this->db->query('SELECT MAX(cap_num) AS lastChapter FROM capitulos WHERE proyecto_id = :id');
			$this->db->bind(':id',$id);
			$comic = $this->db->getSingle();
			return $comic;
		}

		public function addChapter($comic_id,$cap_num,$titulo,$subtitulo,$sinopsis,$autor,$portada,$paginas,$formato,$precio,$estado){
			$this->db->query('INSERT INTO capitulos (proyecto_id,cap_num,titulo,subtitulo,sinopsis,autor,portada,paginas,formato,precio,estado) 
				VALUES (:comic_id, :cap_num, :titulo, :subtitulo, :sinopsis, :autor, :portada, :paginas, :formato, :precio, :estado) ');

			$this->db->bind(':comic_id', $comic_id);
			$this->db->bind(':cap_num', $cap_num);
			$this->db->bind(':titulo', $titulo);
			$this->db->bind(':subtitulo', $subtitulo);
			$this->db->bind(':autor', $autor);
			$this->db->bind(':paginas', $paginas);
			$this->db->bind(':formato', $formato);
			$this->db->bind(':precio', $precio);
			$this->db->bind(':estado', $estado);
			$this->db->bind(':sinopsis', $sinopsis);
			$this->db->bind(':portada', $portada);

		// execute the statement
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}


		public function deleteChapter($id){
			$this->db->query('DELETE FROM capitulos WHERE id = :id' );
			$this->db->bind(':id', $id);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}



	}
?>