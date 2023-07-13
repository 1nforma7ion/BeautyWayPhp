<?php 
	class Database {
		private $host = DB_HOST;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $dbname = DB_NAME;

		private $handler;
		private $stmt;
		private $error;

		public function __construct() {
			$connect = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		 	$timezone = (new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires')))->format('P');

			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				// PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone='$timezone'"
			);

			try {
				$this->handler = new PDO($connect, $this->user, $this->pass, $options);
			} catch (PDOException $e) {
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}

		public function query($sql) {
			$this->stmt = $this->handler->prepare($sql);
		}

		public function bind($param, $value, $type = null) {
			if (is_null($type)) {
				switch(true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}

			$this->stmt->bindValue($param, $value, $type);
		}

		public function execute() {
			return $this->stmt->execute();
		}

		public function getSet() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function getSingle() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		public function rows() {
			return $this->stmt->rowCount();
		}

    public function beginTransaction() {
      return $this->handler->beginTransaction();
    }

    public function commit() {
      return $this->handler->commit();
    }

    public function rollBack() {
      return $this->handler->rollBack();
    }

	}
?>