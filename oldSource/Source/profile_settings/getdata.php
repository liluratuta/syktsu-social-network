<?php

	require_once("../connect.php");
	require_once("../auth/auth-class.php");
	$auth->auth('13zhora13@gmail.com','111111');
	$id_user = $auth->get_id();

	if(is_uploaded_file($_FILES["imagehead"]["tmp_name"])) 
		{
		if ($_FILES['imagehead']['error'] == 0) 
			{
			//Получаем содержимое изображения и добавляем к нему слеш
			$imagetmp = addslashes(file_get_contents($_FILES["imagehead"]["tmp_name"]));

			//Вставляем содержимое изображения в users
			$mysqli->query("UPDATE users SET image_header ='$imagetmp' WHERE id = $id_user");
		}
	}
	header("Location:index.php");

?>