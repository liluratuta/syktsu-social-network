<?php
require __DIR__.'\..\connect.php';
require_once __DIR__.'\auth-class.php';
require __DIR__.'\..\const.php';

$url = $_POST['new-image-url'];
$id = $auth->get_id();

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$link->set_charset("utf8");

$query = "UPDATE users SET icon = '$url' WHERE id = '$id'"; //добавление кода в бд
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

if($result)
	echo 'good'.$CONST_DOMEN.$CONST_IMAGES_FOLDER.$url;
?>