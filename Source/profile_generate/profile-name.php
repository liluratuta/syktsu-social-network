<?php
	require_once __DIR__.'\..\connect.php';
	require_once __DIR__.'\..\const.php';

	$id = $_GET['id'];

	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$query = "SELECT firstname, lastname FROM users WHERE id = $id"; 
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_assoc($result);

	echo "<div class = 'user-name'>".$row['firstname']."</div>";
	echo "<div class = 'user-lastname'>".$row['lastname']."</div>";

?>