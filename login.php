<?php
	session_start();
	require_once 'admin_interface/DB_Fonctions.php';
	$db = new DB_Fonctions();
	if(isset($_POST['email']))
?>