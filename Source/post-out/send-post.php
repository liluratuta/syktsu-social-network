<?php
require_once __DIR__.'\..\connect.php';
require_once __DIR__.'\..\const.php';
require_once __DIR__.'\..\auth\auth-class.php';
require_once __DIR__.'\..\like\write-like-module.php';

if(!$auth->isAuth()) exit('Пожалуйста, авторизируйтесь!');

$id_user = $auth->get_id();
$text = $_POST['text'];
$images = $_POST['images_JSON'];

	$link = mysqli_connect($host, $user, $password, $database) 
    	or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	$query = "INSERT INTO posts VALUES('',$id_user, '$text', CURRENT_TIMESTAMP, '$images')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	

	$query = "SELECT id_post, datetime FROM posts WHERE id_user = $id_user ORDER BY id_post DESC LIMIT 1";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$row = mysqli_fetch_assoc($result);



if(!$result) echo $result;

if ($images == '') 
	$oneImage = 'default.jpg';
else {
	$images = json_decode($images);
	$oneImage = $images[0];
}

echo '{"answer" : "good", "id_post" : "';
echo $row['id_post'];
echo '", "elem" : "';

writeOnePost([
	'id' => $row['id_post'],
	'date_time' => $row['datetime'],
	'imageURL' => $CONST_DOMEN.$CONST_IMAGES_FOLDER.$oneImage,
	'text' => $text
]);

echo '"}';

function writeOnePost($in_data){
	//echoDiv('news-post', "post-".$in_data['id']); // "onclick = 'news_post()'"
	//echo "<div id = 'post-".$in_data['id']."' class = 'news-post'>";
	
		echoDiv('news-post-date');
			echo $in_data['date_time']."</div>";
		echoDiv('news-post-img');
			echo "<img src = '".$in_data['imageURL']."' width = '100%' height = '100%'>";
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
	//echo "</div>";
} 
function echoDiv($class, $id = false, $extra_attr = ''){
	if (!$id) $id = '';
		else $id = "id = '".$id."'";
	echo "<div ".$id." class = '".$class."' ".$extra_attr.">";
}
?>