<?php //параметры подключения к БД

	$main_user = "root";
	$main_pass = "password";
	$main_db = "social-network-bd";

	$mysqli = new mysqli('localhost', $main_user, $main_pass, $main_db);

	if (mysqli_connect_errno()) {
		echo "string";
		exit();
	}

	$mysqli->set_charset("utf8");

	$user_id = 1;

?>