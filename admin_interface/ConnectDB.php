<?php
class ConnectDb {
    private $conn;
    public function connect() {
        require_once 'Conf.php';
		$dsn = "mysql:host=localhost;dbname=CLLDB;charset=utf8";
        $this->conn= new PDO($dsn, DB_USER, DB_PASSWORD);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;
    }
}
?>