<?php 
	
	namespace usuario;

	interface ReqUsuario {
		public function getIdUsuario():string;
		public function getDesUsuario():string;
		public function getSenhaUsuario():string;
		public function getDtCadUsuario();
		public function setIdUsuario($id);
		public function setDesUsuario($des);
		public function setSenhaUsuario($senha);
		public function setDtCadUsuario($dt);
	}

	class Usuario implements ReqUsuario {
		private $idUsuario;
		private $desUsuario;
		private $senhaUsuario;
		private $dtCadUsuario;

		public function getIdUsuario():string {
			return $this->idUsuario;
		}

		public function getDesUsuario():string {
			return $this->desUsuario;
		}

		public function getSenhaUsuario():string {
			return $this->senhaUsuario;
		}

		public function getDtCadUsuario() {
			return $this->dtCadUsuario;
		}

		public function setIdUsuario($id) {
			$this->idUsuario = $id;
		}

		public function setDesUsuario($des) {
			$this->desUsuario = $des;
		}

		public function setSenhaUsuario($senha) {
			$this->senhaUsuario = $senha;
		}

		public function setDtCadUsuario($dt) {
			$this->dtCadUsuario = $dt;
		}

		public function __toString() {
			return json_encode(array(
				"idUsuario" => $this->getIdUsuario(),
				"desUsuario" => $this->getDesUsuario(),
				"senhaUsuario" => $this->getSenhaUsuario(),
				"dtCadUsuario" => $this->getDtCadUsuario()->format("d/m/Y H:i:s")
			));
		}

		public function setData($data) {

			$this->setIdUSuario($data['ID_USUARIO']);
			$this->setDesUsuario($data['DES_USUARIO']);
			$this->setSenhaUsuario($data['SENHA_USUARIO']);
			$this->setDtCadUsuario(new \DateTime($data['DT_CAD_USUARIO']));
		}

		public function loadById($id) {
			$sql = new \Ado;
			$results = $sql->select("SELECT * FROM TB_USUARIO WHERE ID_USUARIO = :ID", array(
				":ID" => $id
			));

			if(count($results) > 0) {

				$this->setData($results[0]);

			}
		}

		public static function getList() {
			$sql = new \Ado;
			return $sql->select("SELECT * FROM TB_USUARIO ORDER BY DES_USUARIO");
		}

		public static function search($des) {
			$sql = new \Ado;
			return $sql->select("SELECT * FROM TB_USUARIO WHERE DES_USUARIO LIKE :LOGIN", array(
				":LOGIN" => "%".$des."%"
			));
		}

		public function logar($des, $senha) {
			$sql = new \Ado;
			$results = $sql->select("SELECT * FROM TB_USUARIO WHERE DES_USUARIO = :DES AND SENHA_USUARIO = :SENHA", array(
				":DES" => $des,
				":SENHA" => $senha
			));

			if(count($results) > 0) {

				$this->setData($results[0]);
			}
		}

		public function update($user, $senha) {
			$sql = new \Ado;

			$this->setDesUsuario($user);
			$this->setSenhaUsuario($senha);

			$sql->query("UPDATE TB_USUARIO SET DES_USUARIO = :DES, SENHA_USUARIO = :SENHA WHERE ID_USUARIO = :ID", array(
				":DES" => $this->getDesUsuario(),
				":SENHA" => $this->getSenhaUsuario(),
				":ID" => $this->getIdUsuario()
			));
		}

		public function delete() {
			$sql = new \Ado;

			$sql->query("DELETE FROM TB_USUARIO WHERE ID_USUARIO = :ID", array(
				":ID" => $this->getIdUsuario()
			));

			$this->setIdUsuario(0);
			$this->setDesUsuario("");
			$this->setDtCadUsuario(new \DateTime());
			$this->setSenhaUsuario("");
		}

		public function insert() {
			$sql = new \Ado;
			$results = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASSWORD)", array(
				":LOGIN" => $this->getDesUsuario(),
				":PASSWORD" => $this->getSenhaUsuario()
			));

			if(count($results) > 0) {
				$this->setData($results[0]);
			}
		}
	}
 ?>