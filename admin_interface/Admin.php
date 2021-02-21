<?php  
    class DB_Fonctions{

        private $conn;
    
        // constructor
        function __construct() {
            require_once 'ConnectDb.php';
            // connecting to database
            $db = new ConnectDB();
            $this->conn = $db->connect();
        }
?>