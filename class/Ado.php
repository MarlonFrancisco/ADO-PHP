<?php 
	class Ado extends PDO {

		private $conn;

		public function __construct() {
			$this->conn = new PDO("mysql:host=localhost;dbname=DB_PHP7", "root", "");
		}

		public function setParams($statement, $params) {
			foreach($params as $key => $value) {
				$this->setParam($statement, $key, $value);
			}
		}

		public function setParam($statement, $key, $value) {
			$statement->bindParam($key, $value);
		}
		public function query($rowQuery, $params = array()) {
			$stmt = $this->conn->prepare($rowQuery);
			
			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;
		}

		public function select($rowQuery, $params = array()):array {
			$stmt = $this->query($rowQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}
	}
 ?>