<?php
	require("connect.php");
	require_once("auth/auth-class.php");

	// if (!isset($_POST['email']) || !isset($_POST['password'])) {
	// 	header("location: index.php");
	// }

	// $email = $_POST['email'];
	// $pass = $_POST['password'];

	// auth->auth($email, $pass);

	header("location: messenger/index.php");

?>