<!DOCTYPE html>
<html>
<head>
	<meta charset = 'utf-8'>
	 <link rel="stylesheet" type="text/css" href="css/like.css">
</head>
<body>
<?php
//require_once 'write-like-module.php';
?>
<!-- <div id="post-1" class = "like true-like" data-count = "0">
	<button onclick="sendLike(1,1,1)">Like</button>
	<button onclick="sendLike(1,1,0)">Dislike</button>
	

</div>
<div id="post-1" class = "like false-like">
	<button onclick="">Like</button>
	<button onclick="">Dislike</button>
</div> -->
<?php
require_once '../connect.php';
require_once '../auth/auth-class.php';
drawLikePost(1,1);
function drawLikePost($id_post_or_comment, $bool_PoC){ 
	global $user, $host, $password, $database;
	global $auth;
	$count = 0;
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	$link->set_charset("utf8");

	if($auth->isAuth()){
		$query = "SELECT bool_like FROM likes WHERE id_post_or_comment = '".$id_post_or_comment."' AND bool_PoC = '".$bool_PoC."' AND id_user = '".$auth->getId()."'"; //чекаем существование лайка
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$row = mysqli_fetch_assoc($result);
		if(isset($row)){
			if($row['bool'] == 1) $extra_class = ' true-like'; else $extra_class = ' false-like';
		} else {
			$extra_class = '';
		}
	} else $extra_class = '';

	$query = "SELECT * FROM likes WHERE id_post_or_comment = '".$id_post_or_comment."' AND bool_PoC = '".$bool_PoC."' ORDER BY id_like DESC"; //чекаем существование лайка
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	while($row = mysqli_fetch_assoc($result)){
		if($row['bool_like']) $count++; else $count--;
	}
	echo "<div id = '".$bool_PoC."-".$id_post_or_comment."' class = 'like-div".$extra_class."'>";
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
<div id = '1-1' class="like-div">

						<div  class="like-number">5</div>
						<div class="like" name="like" >
							<a href="#like" onclick="sendLike(1,1,1)" title="like">
								<div class="like-icon"></div>
							</a>
						</div>
						<div class="dislike" name="dislike">
							<a href="#dislike" onclick="sendLike(1,1,0)" title="dislike">
								<div class="dislike-icon"></div>
							</a>
						</div>
					</div>
	<script type="text/javascript">
		
		function sendLike(id_post_or_comment, bool_PoC, bool_like){ 
			var http = new XMLHttpRequest();
    		var url = "like-script.php"; //менять эту настройку
    		
    		var params = "bool_like="+bool_like+"&id_post_or_comment="+id_post_or_comment+"&bool_PoC="+bool_PoC;
    
		    http.open("POST", url, true);
		    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options = http.responseText;
		    	var id = bool_PoC + "-" + id_post_or_comment;
		    	console.log(server_options);
		    	var elem = document.getElementById(id);
		    	elem.classList.remove('false-like');
		    	elem.classList.remove('true-like');
		    		if (server_options === '1') {
		    			elem.classList.add('true-like');
		    		} else if (server_options === '0') {
		    			
		    			elem.classList.add('false-like');
		    		} else if (server_options === 'delete'){
		    			elem.setAttribute('class', 'like');
		    		}
		    	
		   		}
			}
			http.send(params);
		}
	</script>
</body>
</html>