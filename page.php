<?php
require_once __DIR__.'/Source/page-generate/PG-functions.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php getTitleNameForPage() ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Source+Sans+Pro" rel="stylesheet">
	<script src="Source/page-js/index.js"></script>
	<script src="Source/page-js/Auth.js"></script>
	<script src="Source/page-js/openPost.js"></script>
	<script src="Source/page-js/sendComments.js"></script>
	<script src="Source/page-js/sendPost.js"></script>
	<script src="Source/page-js/bindClose.js"></script>
	<script src="Source/page-js/sendLike.js"></script>
</head>
<body id="body">
	<div class="bodydark" id='dark'></div>
	<div class="header" >
		<a name="header"></a>
		<div class=header-top-div>
			<div class="header-name">
				<span class="span-name">I</span>
				<span class="span-name">S</span>
				<span class="span-name">N</span>
			</div>
			<div class="header-logo">
				<a href="page.php">
				<img src="images/icon.png" width="58" height="58" class="header-logo-img">
			</a>
			</div>
			<a href="#" onclick="setting_show()">
			<div class="header-settings"></div></a>
		</div>

		<div class="profile-image">
			<div class="header-settings-div" id='set-div'>
			<ul class="settings-list">
				<li class="settings-list-item"><a >Моя страница</a></li>
				<li class="settings-list-item"><a href="../Source/profile_settings/index.php">Настройки</a></li>
				<li class="settings-list-item"><a href="">Поддержка</a></li>
				<li class="settings-list-item"><a href="#">Выйти</a></li>
			</ul>
		</div>
		</div>

		<div class="header-image" <?php if($id == $auth->get_id()) echo "onclick = 'authUser.replaceUserIcon()'" ?>>
			<img src=<?php echo "'".getImageUrlForPage()."'"; ?>width="150" height="150" class="header-image-img">
		</div>
		
		<div class="header-bottom-div">
			<div class="header-bottom-buttons">
				<div class="button-div">
					<a href="dialogs.php" name="dialog" class="dialog-button">Диалоги</a> 
				</div>
				<div class="button-div">
				 <a href="friends.html" name="friend"class="friends-button">Друзья</a>
				</div>
			</div>
		</div>  
	</div>

	<div class="error" id='error'>
		<div class="error-div">
			<div class="error-text">Ошибка загрузки файла</div>
		</div>
	</div>

	<div class="main" id="main">
		<div class="user">
			<?php
				require_once __DIR__.'/Source/page-generate/profile-name.php';
			?>
		</div>


		<div class="new-post" >
			<div class="new-post-header">Новый пост</div>
			<div class="new-post-text">				
				<textarea class="new-post-input" placeholder="Введите..."></textarea>
			</div>

			<div class="new-post-pre-img">
			
			</div>

			<div class="new-post-img">
				<button class="new-img-button" onclick="postWriter.openFile()"></button>
			</div>
			<div class="new-post-publish">
				<button class="new-post-button" onclick="postWriter.send()"></button>
			</div>
		</div>



		<div class="news" id="news">
				<div class="news-header">Новости</div>
				<div class="news-header-line"></div>
		<?php

			//require_once '../auth/auth-class.php';
			//require_once '../connect.php';
			//require_once '../const.php';
			//require_once __DIR__.'/Source/like/write-like-module.php';
			//echo $auth->get_Id();
			//require_once __DIR__.'/Source/write-posts.php';
			writeUserPosts($id);
			
		?>		
		
	</div>


	<script>
		var id_page_user = <?php echo $_GET['id']?>;
		var id_auth_user = <?php if ($auth->isAuth()) echo $auth->get_id(); else echo "'none'"; ?>; 
		var forOP;
		console.log(id_page_user, id_auth_user);
		if (id_auth_user != id_page_user) 
			forOP = 'none'; 
		else 
			forOP = id_page_user;
		console.log(forOP);
		var comments = new comments(id_page_user,id_auth_user);
		var postWriter = new post(forOP);
		var openPost = new openPost();
		var authUser = new auth(id_auth_user);
	</script>


	<div class="footer">
		<div class="copyright"> 
			<span>&copy 2019-2020 Inimical Social network</span>
		</div>
		<div class="footer-up-button">
			<a href="#header" class="up-button">
				<div class="up-button-img"></div>
			</a>
		</div>
	</div>
</body>
</html>