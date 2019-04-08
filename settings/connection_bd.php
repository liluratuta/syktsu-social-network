<?php
	$main_user = "root";
	$main_pass = "";
	$main_db = "social-network-bd";

	$mysqli = new mysqli('localhost', $main_user, $main_pass, $main_db);

	if ($mysqli->connect_errno) {
		echo "База данных не подлючена";
		exit();
	}
	$mysqli->set_charset("utf8");
?>