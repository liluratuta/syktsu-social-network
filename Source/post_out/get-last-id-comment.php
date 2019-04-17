<?php
	require_once __DIR__.'\..\connect.php';
	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$query = "SELECT id_comment FROM comments ORDER BY id_comment DESC LIMIT 1"; 
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_assoc($result);

	echo 'Good';
	echo $row['id_comment'];
?>