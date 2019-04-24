<?php
require_once '../connect.php';
require_once '../const.php';
echo getImageUrl(2);
echo "<img src = '".getImageUrl(2)."'>";
function getImageUrl($id){
	global $host, $user, $password, $database, $CONST_DOMEN, $CONST_IMAGES_FOLDER;
	$link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
    $link->set_charset("utf8");
    $query ="SELECT name_image FROM images WHERE id_image = '".$id."'";     
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    $url = $CONST_DOMEN.$CONST_IMAGES_FOLDER.$row['name_image'];
	return $url;
}
?>