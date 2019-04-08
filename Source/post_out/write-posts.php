<?php
writeOnePost([
	'id' => 3,
	'date_time' => '04.04.2019 14:21',
	'text' => 'тело новости'
]);
writeOnePost([
	'id' => 4,
	'date_time' => '04.04.2019 14:21',
	'text' => 'тело новости'
]);
writeOnePost([
	'id' => 5,
	'date_time' => '04.04.2019 14:21',
	'text' => 'тело новости'
]);

function writeOnePost($in_data){
	echoDiv('news-post', "post-".$in_data['id']);
	//echo "<div id = 'post-".$in_data['id']."' class = 'news-post'>";
	echoDiv('news-post-img');
	echo "</div>"; //тут изображение
	echoDiv('news-post-text');
	echo $in_data['text']."</div>";
	echoDiv('feedback');
	echoDiv('comment'); //тут где то коменты
	echo "<input type = 'text' name = 'comment placeholder = 'Комментарий...' class = 'comment-input'>";
	echo "</div>";
	//cюда вставляем лайк
	echo "</div>";
} 
function echoDiv($class, $id = false, $extra_attr = ''){
	if (!$id) $id = '';
		else $id = "id = '".$id."'";
	echo "<div ".$id." class = '".$class."' ".$extra_attr.">";
}
?>