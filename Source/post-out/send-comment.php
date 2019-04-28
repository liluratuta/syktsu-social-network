<?php
	require_once __DIR__."/../connect.php";
	require_once __DIR__."/../auth/auth-class.php";

	if(!$auth->isAuth()) exit('Пожалуйста, авторизируйтесь!');

	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$id_post = $_POST['id_post'];
	$id_user = $auth->get_id();
	$text = $_POST['text'];

	$query = "INSERT INTO comments VALUES('',$id_post, $id_user, '$text', CURRENT_TIMESTAMP)";
	//echo $query;
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	if($result)
		echo 1;
	else 
		echo 'ERROR';
	mysqli_close($link);
?>