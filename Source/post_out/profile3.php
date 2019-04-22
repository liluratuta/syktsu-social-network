<!DOCTYPE html>
<html>
<head>
	<title>Имя пользователя</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Source+Sans+Pro" rel="stylesheet">
	<script src="index.js"></script>
	<script src="sendComments.js"></script>
	<script src="sendPost.js"></script>
	<script src="../like/js/sendLike.js" type="text/javascript"></script>
	<script src="openPost.js"></script>
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
				<a href="profile.html">
				<img src="images/logo.png" width="58" height="58">
			</a>
			</div>
			<a href="#" onclick="setting_show()">
			<div class="header-settings"></div></a>
		</div>
		<div class="header-settings-div" id='set-div'>
			<ul class="settings-list">
				<li class="settings-list-item"><a href="profile.html">Моя страница</a></li>
				<li class="settings-list-item"><a href="">Настройки</a></li>
				<li class="settings-list-item"><a href="">Поддержка</a></li>
				<li class="settings-list-item"><a href="auth_reg.html">Выйти</a></li>
			</ul>
		</div>

		<div class="header-image">
			<img src="images/user.png" width="150" height="150">
		</div>
		<div class="profile-image"></div>
		<div class="header-bottom-div">
			<div class="header-bottom-buttons">
				<div class="button-div">
					<a href="dialogs.html" name="dialog" class="dialog-button">Диалоги</a> 
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
			<div class="user-name">Имя </div>
			<div class="user-lastname"> Фамилия</div>
		</div>
		<div class="new-post">
			<div class="new-post-header">Новый пост</div>
			<div class="new-post-text">				
				<textarea class="new-post-input" placeholder="Введите..."></textarea>
			</div>
			<div class="new-post-attach" id="attach" onmouseover="attach_img()">
				<img src="images/example.jpg" class="attach-img">
			</div>
			<div class="new-post-delete" id="delete">
				<img src="images/cross.png" class="delete-img">
			</div>
			<div class="new-post-img">
				<button class="new-img-button"></button>
			</div>
			<div class="new-post-publish">
				<button class="new-post-button"></button>
			</div>
		</div>
		<div class="news" id="news">
				<div class="news-header">Новости</div>
				<div class="news-header-line"></div>
				<?php
			require_once '../auth/auth-class.php';

			require_once '../connect.php';
			require_once '../const.php';
			require_once '../like/write-like-module.php';
			$auth->auth('test@gmail.com','1');
			//echo $auth->get_Id();
			require_once 'write-posts.php';
			writeUserPosts(3);
			
			?>
			<div class="news-post" id="news-post" >
				<div class="news-post-date">14.03.2019 10:27</div>
				<div class="news-post-img" onclick="news_post()">
					<img src="images/post_img.jpg" width="100%" height="100%">
				</div>
				
				<div class="news-post-text">23-24 апреля на базе Сыктывкарского госуниверситета имени Питирима Сорокина при поддержке Минфина Республики Коми запланировано проведение Всероссийской научной конференции школьников, студентов и аспирантов «Финансовые технологии и финансовые инновации в индустрии 4.0».</div>
				<div class="feedback">
					<div class="comment">
						<a href="#comment" title="comment" onclick="new_comment()">
							<div class="comment-icon"></div>
						</a>
					</div>
					<div class="like-div">
						<div class="like-number">5</div>
						<div class="like" name="like" >
							<a href="#like" title="like">
								<div class="like-icon " id='like_false'></div>
								<div class="like-true" id='like_true'></div>
							</a>
						</div>
						<div class="dislike" name="dislike">
							<a href="#dislike" title="dislike">
								<div class="dislike-icon" id='dislike_false'></div>
								<div class="dislike-true" id='dislike_true'></div>
							</a>
						</div>
					</div>
				</div>
				<div class="comment-pop-out" id="comment-pop-out">
					<div class="comment-pop-out-user">
						<div class="out-user-img">
							<img src="images/user.png" width="30px" height="30px">
						</div>
						<div class="out-user-name">Имя пользователя</div>
					</div>
					<div class="out-short-text">23-24 апреля на базе Сыктывкарского госуниверситета имени Питирима Сорокина</div>
					<div class="comment-pop-out-text">
						<div class="comment-pop-out-text-in">
							<input type="text" name="pop-out-comment" class="pop-out-comment-input">
						</div>
						<div class="pop-out-button">
							<button class="pop-out-publish"></button>
						</div>
					</div>
				</div>
				<div class="comment-out">
					<div class="comment-out-img">
						<img src="images/user.png" height="100%" width="100%"> 
					</div>
					<div class="comment-out-inf">
					<div class="comment-out-name">Имя пользователя</div>
					<div class="comment-out-date">10.04.2019 10.01</div>
					</div>
					<div class="comment-out-text"> Пример комментарияПример комментарияПример комментарияПример комментарияПример комментарияПример комментария</div>
				</div>
				<div class="like-div comment-like">
						<div class="like-number com-like-number">5</div>
						<div class="like" name="like" >
							<a href="#like" title="like">
								<div class="like-icon com-like-icon"></div>
							</a>
						</div>
						<div class="dislike" name="dislike">
							<a href="#dislike" title="dislike">
								<div class="dislike-icon com-dislike-icon"></div>
							</a>
						</div>
					</div>

				
				
			</div>
		</div>
			<div class="news-post-pop-out" id="news-post-pop-out" style="display: none;">
				<div class="news-post-pop-out-back">
					<a href=""></a>
				</div>
				<div class="news-post-pop-out-date">14.03.2019 10:27</div>
				<div class="news-post-pop-out-img" id="small_img" onclick="img_origin()">
					<img src="images/post_img.jpg" height="100%" width="100%">
				</div>
				
				<div class="news-post-pop-out-text">
Цель мастер-класса — рассказать о педагогических технологиях, в частности об интерактивном обучении, а также о приемах для эффективного использования данной технологии в профессиональной деятельности студентов. Участники мероприятия не только практиковались в использовании электронной доски, но и учились работать на публику. Помогала им в этом доцент кафедры начального образования, кандидат педагогических наук Вита Поберезкая.<br>
— Ваша задача сегодня — научиться доносить идею до аудитории. Будущему учителю необходимо уметь держать слово, ведь в дальнейшем вы пойдете работать в школу. Необходимо внедрять новые технологии в образовательный процесс, чтобы быть на «одной волне» с современными детьми, — подчеркнула преподаватель.Мастер-класс был построен на непосредственном взаимодействии преподавателя со студентами. Участники разделились на четыре команды — «Учителя», «Педагоги», «Двоечки», «Копилка знаний» — и размышляли над вопросом: «Что нужно для эффективного взаимодействия в группе?». Вита Федоровна направляла каждую команду, давала советы и помогала в развитии идей.После обсуждений в группах, Вита Поберезкая пригласила по одному спикеру из каждой команды для работы на Smart-доске.<br>Студенты фиксировали самые главные положения, которые были придуманы ранее. Каждый представитель своей команды уверено вел себя перед аудиторией, четко высказывал свою позицию и приводил примеры.
				</div>

				<div class="feedback">
					<div class="comment">
						<div class="comment-icon"></div>
					</div>
					<div class="like-div pop-out-like-div">
						<div class="like-number">5</div>
						<div class="like" name="like" >
							<a href="#like" title="like">
								<div class="like-icon"></div>
							</a>
						</div>
						<div class="dislike" name="dislike">
							<a href="#dislike" title="dislike">
								<div class="dislike-icon"></div>
							</a>
						</div>
					</div>
				</div>
				<div class="comment-out">
					<div class="comment-out-img">
						<img src="images/user.png" height="100%" width="100%"> 
					</div>
					<div class="comment-out-inf">
					<div class="comment-out-name">Имя пользователя</div>
					<div class="comment-out-date">10.04.2019 10.01</div>
					</div>
					<div class="comment-out-text"> Пример комментарияПример комментарияПример комментарияПример комментарияПример комментарияПример комментария</div>
				</div>

			</div>
			
		
	</div>
<div class="news-post-pop-out-origin-img" id="origin_img">
				<img src="images/post_img.jpg" height="100%" width="100%" id='pop_out_orig_img'>
			</div>


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
	<script>
				var comments = new comments(3);
				var postWriter = new post(3);
				var openPost = new openPost();

			</script>
</body>
</html>