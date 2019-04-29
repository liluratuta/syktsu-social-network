<?php //параметры подключения к БД

	$main_user = "host1758396";
	$main_pass = "aee80521";
	$main_db = "host1758396";
	$main_host = 'localhost';

	$mysqli = new mysqli($main_host, $main_user, $main_pass, $main_db);

	if (mysqli_connect_errno()) {
		echo "string";
		exit();
	}

	$mysqli->set_charset("utf8");

	//for_arthur_scripts

	$host = $main_host; // адрес сервера 
	$database = $main_db; // имя базы данных
	$user = $main_user; // имя пользователя
	$password = $main_pass; // пароль
?>