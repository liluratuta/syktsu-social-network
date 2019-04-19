<?php
require_once 'connect.php'; 
session_start();
$id = 0;
$link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
    $link->set_charset("utf8");
//echo "<table>"

$query ="SELECT * FROM posts ORDER BY date DESC LIMIT 10"; //mysql загуглить
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while ($row = mysqli_fetch_assoc ($result)) { //строчки
	if ($row['id_user'] == $id) {
		echo "<div class='news-post-img'>"
		echo "<img src=\"".$row['picture']."\">";
		echo "</div>";
		echo "<div class='news-post-date'>"
		echo $row['date'];
		echo "</div>";
		echo "<div class='news-post-text'>"
		echo $row['text'];
		echo "</div>";
		}
//echo <tr>
	}
//echo "</table>"
mysqli_close($link);
?>