<?php


//need write-like-module.php
function writeOnePost($in_data){
	echoDiv('news-post', "post-".$in_data['id']);
	//echo "<div id = 'post-".$in_data['id']."' class = 'news-post'>";
	echoDiv('news-post-img');
	echo "</div>"; //тут изображение
	echoDiv('news-post-date');
	echo $in_data['date_time']."</div>";
	echoDiv('news-post-text');
	echo $in_data['text']."</div>";
	echoDiv('feedback');
	echoDiv('comment'); //тут где то коменты
	echo "<input type = 'text' name = 'comment' placeholder = 'Комментарий...' class = 'comment-input'>";
	echo "</div>";
	drawLikePost($in_data['id'], 1);
	echo "</div>";
	echo "</div>";
} 
function echoDiv($class, $id = false, $extra_attr = ''){
	if (!$id) $id = '';
		else $id = "id = '".$id."'";
	echo "<div ".$id." class = '".$class."' ".$extra_attr.">";
}
function writeUserPosts($id_user){
	global $host, $user, $password, $database;
	global $CONST_LIMIT_POSTS;
	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");
	$query = "SELECT * FROM posts WHERE id_user = '$id_user' ORDER BY datetime DESC LIMIT $CONST_LIMIT_POSTS"; //чекаем существование лайка
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	while($row = mysqli_fetch_assoc($result)){
		writeOnePost([
			'id' => $row['id_post'],
			'date_time' => $row['datetime'],
			'text' => $row['text']
		]);
	}
}
?>