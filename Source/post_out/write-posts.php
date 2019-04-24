<?php

function writeFullCommentary($id_post){
	global $host, $user, $password, $database;
	global $CONST_LIMIT_COMMENTS, $CONST_DOMEN, $CONST_IMAGES_FOLDER;
	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$query = "SELECT comments.id_comment, users.firstname, users.lastname, users.icon, comments.datetime, comments.text FROM comments, users WHERE  comments.id_post = $id_post AND comments.id_user = users.id ORDER BY comments.datetime LIMIT $CONST_LIMIT_COMMENTS"; 
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	
	while($row = mysqli_fetch_assoc($result)){
		if($row['icon'] == '') 
			$image = 'default.jpg';
		else 
			$image = $row['icon'];

		writeOneCommentary([
			'id_comment' => $row['id_comment'],
			'author' => $row['firstname']." ".$row['lastname'],
			'img_url' => $CONST_DOMEN.$CONST_IMAGES_FOLDER.$image,
			'datetime' => $row['datetime'],
			'text' => $row['text']
		]);
	}
	

}

function writeOneCommentary($in_data){ //добавить ёбанную кнопку, чтобы было ровно!!!
	echoDiv('comment-out');
		echoDiv('comment-out-img');
			echo "<img src = '".$in_data['img_url']."' width = '100%' height = '100%'></div>";
		echoDiv('comment-out-inf');
			echoDiv('comment-out-name');
				echo $in_data['author']."</div>";
			echoDiv('comment-out-date');
				echo $in_data['datetime']."</div>";
			echo "</div>";
		echoDiv('comment-out-text');
			echo $in_data['text']."</div>";
		//echo "</div>";
		drawLikePost($in_data['id_comment'], 0);
	echo "</div>";
}
//need write-like-module.php
function writeOnePost($in_data){
	echoDiv('news-post', "post-".$in_data['id']); // "onclick = 'news_post()'"
	//echo "<div id = 'post-".$in_data['id']."' class = 'news-post'>";
	
		echoDiv('news-post-date');
			echo $in_data['date_time']."</div>";
		echoDiv('news-post-img');
			echo "<img src = '".$in_data['imageURL']."' width = '100%' height = '100%' )'>";
			echo "</div>"; //тут изображение
		echoDiv('news-post-text');
			echo $in_data['text']."</div>";
		echoDiv('feedback');
			echoDiv('comment');
				echo "<a href = '#comment' title = 'comment' onclick = 'comments.activePost(".$in_data['id'].")' >";
					echoDiv('comment-icon');
						echo '</div>'; 
					echo '</a>';
				echo '</div>';
				//тут где то коменты
			//echo "<input type = 'text' name = 'comment' placeholder = 'Комментарий...' class = 'comment-input'>";
				
			drawLikePost($in_data['id'], 1);
			echo "</div>";
		echoDiv('comment-pop-out'); 
			echo "</div>";
		writeFullCommentary($in_data['id']);
	echo "</div>";
} 
function echoDiv($class, $id = false, $extra_attr = ''){
	if (!$id) $id = '';
		else $id = "id = '".$id."'";
	echo "<div ".$id." class = '".$class."' ".$extra_attr.">";
}
function writeUserPosts($id_user){
	global $host, $user, $password, $database;
	global $CONST_LIMIT_POSTS, $CONST_DOMEN, $CONST_IMAGES_FOLDER;
	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");
	$query = "SELECT * FROM posts WHERE id_user = '$id_user' ORDER BY datetime DESC LIMIT $CONST_LIMIT_POSTS"; //чекаем существование лайка
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	while($row = mysqli_fetch_assoc($result)){
		if($row['images'] == '')
			$imageURL = $CONST_DOMEN.$CONST_IMAGES_FOLDER."default.jpg";
		else {
			$imageURL = json_decode($row['images']);
			$imageURL = $CONST_DOMEN.$CONST_IMAGES_FOLDER.$imageURL[0];
		}

		writeOnePost([
			'id' => $row['id_post'],
			'date_time' => $row['datetime'],
			'imageURL' => $imageURL,
			'text' => $row['text']
		]);
	}
}
?>