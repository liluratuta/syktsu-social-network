<?php
require '../connect.php';

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
$link->set_charset("utf8");

$query = "SELECT * FROM likes WHERE id_post_or_comment = 1"; //чекаем существование лайка
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_assoc($result);

if (!isset($row)){
	$class = '';
} else {
	if ($row['bool_like'] == 1) $class = 'true-like';
		else $class = 'false-like';
}
echo $class;
echo "<div id='post-1' class = 'like ".$class."'>";
echo "<button onclick='sendLike(1,1,1)'>Like</button>";
echo "<button onclick='sendLike(1,1,0)'>Disike</button>";
echo "</div>";
?>