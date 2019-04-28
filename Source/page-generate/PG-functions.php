<?php
	require __DIR__.'\..\connect.php';
	require_once __DIR__.'\..\auth\auth-class.php';
	require __DIR__.'\..\const.php';
	require_once __DIR__.'\..\post-out\write-posts.php';
	require_once __DIR__.'\..\like\write-like-module.php';
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$id = $_GET['id'];


	function getImageUrlForPage(){
		global $link,$id, $CONST_DOMEN, $CONST_IMAGES_FOLDER;

		$query = "SELECT icon FROM users WHERE id = '$id'"; 
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$row = mysqli_fetch_row($result);

		if(isset($row['icon']))
			return $CONST_DOMEN.$CONST_IMAGES_FOLDER.$row['icon'];
		else 
			return $CONST_DOMEN.$CONST_IMAGES_FOLDER.'default.jpg';
	}
// $query = "SELECT mail FROM users WHERE verification = '".$_GET['ver_code']."'"; 
// $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
// $row = mysqli_fetch_row($result);
?>