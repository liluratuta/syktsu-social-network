<!DOCTYPE html>
<html>
<head>
	<meta charset = 'utf-8'>
	 <link rel="stylesheet" type="text/css" href="css/like.css">
</head>
<body>
<?php
require_once 'write-like-module.php';
?>
<!-- <div id="post-1" class = "like true-like" data-count = "0">
	<button onclick="sendLike(1,1,1)">Like</button>
	<button onclick="sendLike(1,1,0)">Dislike</button>
	

</div>
<div id="post-1" class = "like false-like">
	<button onclick="">Like</button>
	<button onclick="">Dislike</button>
</div> -->
	<script type="text/javascript">
		
		function sendLike(id_post_or_comment, bool_PoC, bool_like){ 
			var http = new XMLHttpRequest();
    		var url = "like_script.php"; //менять эту настройку
    
    		var params = "bool_like="+bool_like+"&id_post_or_comment="+id_post_or_comment+"&bool_PoC="+bool_PoC;
    
		    http.open("POST", url, true);
		    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options = http.responseText;
		    	console.log(server_options);
		    	var elem = document.getElementById('post-1');
		    		if (server_options === 1) {
		    			elem.setAttribute('class', 'like true-like');
		    		} else if (server_options === 0) {
		    			elem.setAttribute('class', 'like false-like');
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