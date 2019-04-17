<?php
	require_once __DIR__.'\..\connect.php';
	require_once __DIR__.'\..\auth\auth-class.php';
	require_once __DIR__.'\..\like\write-like-module.php';
	require_once __DIR__.'\..\const.php';

	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$last_id = $_POST['id_last_comment'];
	$id_page = $_POST['id_page'];

	$query = "SELECT id_comment FROM comments ORDER BY id_comment DESC LIMIT 1"; 
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_assoc($result);
	if(!isset($row)) exit('Error::line:15');
	if ($row['id_comment'] == $last_id) exit('none');

	$query = "SELECT comments.id_post, users.icon, users.firstname, users.lastname, comments.datetime, comments.text, comments.id_comment FROM comments, users, posts WHERE comments.id_user = users.id AND comments.id_comment > $last_id AND posts.id_post = comments.id_post AND posts.id_user = $id_page ORDER BY id_comment"; 
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	if($result) echo 'good';

	echo "{";
	$first_iter = true;
	while ($row = mysqli_fetch_assoc($result)){

		if (!$first_iter) 
			echo ", ";
		else
			$first_iter = false;

		if($row['icon'] == '') 
			$image = 'default.jpg';
		else 
			$image = $row['icon'];

		echo '"'.$row['id_comment'].'":["';
		writeOneCommentaryForJS([
			'img_url' => $CONST_DOMEN.$CONST_IMAGES_FOLDER.$image,
			'author' => $row['firstname']. " " . $row['lastname'],
			'datetime' => $row['datetime'],
			'text' => $row['text'],
			'id_comment' => $row['id_comment']
		]);
		echo '",'.$row['id_post'].']';	
	}
	echo "}";
	

	function writeOneCommentaryForJS($in_data){ //добавить ёбанную кнопку, чтобы было ровно!!!
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

	}
	function echoDiv($class, $id = false, $extra_attr = ''){
		if (!$id) $id = '';
			else $id = "id = '".$id."'";
		echo "<div ".$id." class = '".$class."' ".$extra_attr.">";
	}
?>