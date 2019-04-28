<?php
	require_once __DIR__.'/../connect.php';

	$out = [];
	$id_post = $_POST['id_post'];

	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$query = "SELECT text, images FROM posts WHERE id_post = $id_post";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_assoc($result);

	$out['text'] = $row['text'];

	if(isset($row['images '])) 
		$out['images'] = 'not-images';
	else 
		$out['images'] = $row['images'];	
	$out['answer'] = 'good';

	echo json_encode($out);
?>