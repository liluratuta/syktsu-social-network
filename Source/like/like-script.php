<?php
require_once '../connect.php';
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$link->set_charset("utf8");

$id_user = 1; //присвоиться с помощью метода класса

$bool_PoC = $_POST['bool_PoC'];
$id_post_or_comment = $_POST['id_post_or_comment'];
$bool_like = $_POST['bool_like'];

$query = "SELECT * FROM likes WHERE bool_PoC = ".$bool_PoC." AND id_user = ".$id_user." AND id_post_or_comment = ".$id_post_or_comment.""; //чекаем существование лайка
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result);
if(isset($row)){
	//echo "есть совпадение";
	if($row[4] == $bool_like) {
		//echo " убираем лайк/дизлайк";
		$query = "DELETE FROM likes WHERE id_like = ".$row[0];
		$out = ' ';
		$out = 'delete';
	} else {
		//echo " заменяем лайк/дизлайк";
		$query = "UPDATE likes SET bool_like = '". (1-$row[4])."' WHERE id_like = '".$row[0]."'" ;
		$out = 1 - $row[4];
	} 
}
else {
	$query = "INSERT INTO likes VALUES('',$id_user,$id_post_or_comment,$bool_PoC,$bool_like)";
	$out = $bool_like;
}
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result) echo $out;
?>