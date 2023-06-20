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