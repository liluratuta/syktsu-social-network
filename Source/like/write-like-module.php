<?php
//need auth-class.php and connect.php
function drawLikePost($id_post_or_comment, $bool_PoC){ 
	global $user, $host, $password, $database;
	global $auth;
	$count = 0;
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	if($auth->isAuth()){
		$query = "SELECT bool_like FROM likes WHERE id_post_or_comment = '".$id_post_or_comment."' AND bool_PoC = '".$bool_PoC."' AND id_user = '".$auth->get_Id()."'"; //чекаем существование лайка
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$row = mysqli_fetch_assoc($result);
		if(isset($row)){
			if($row['bool_like'] == 1) $extra_class = ' like-true'; else $extra_class = ' dislike-true';
		} else {
			$extra_class = '';
		}
	} else $extra_class = '';

 	if (!$bool_PoC) 
 		$extra_class.= ' comment-like';
	$query = "SELECT * FROM likes WHERE id_post_or_comment = '".$id_post_or_comment."' AND bool_PoC = '".$bool_PoC."' ORDER BY id_like DESC"; //чекаем существование лайка
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	while($row = mysqli_fetch_assoc($result)){
		if($row['bool_like']) $count++; else $count--;
	}
	echo "<div id = 'like-".$bool_PoC."-".$id_post_or_comment."' class = 'like-div".$extra_class."'>";
	echo "<div class = 'like-number'>".$count."</div>";
	echo "<div class = 'like'>"; //зачем атрибут имя 
	echo "<a href = '#like' onclick = 'sendLike(".$id_post_or_comment.", ".$bool_PoC.", 1)'>";
	echo "<div class = 'like-icon'></div>";
	echo "</a></div>";
	echo "<div class = 'dislike'>"; //зачем атрибут имя 
	echo "<a href = '#dislike' onclick = 'sendLike(".$id_post_or_comment.", ".$bool_PoC.", 0)'>";
	echo "<div class = 'dislike-icon'></div>";
	echo "</a></div></div>";

	

}
?>