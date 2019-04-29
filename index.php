<?php 
require_once __DIR__.'/Source/auth/auth-class.php';
require __DIR__.'/Source/const.php';
if ($auth->isAuth())
	header('Location: '.$CONST_DOMEN.'page.php?id='.$auth->get_id());
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/auth-reg-styles.css">
	<meta charset="utf-8">
	<script src="Source/page-js/index.js"></script>
	<script src="Source/page-js/Auth.js"></script>
	
</head>
<body>
	<header>
		<div class="index-header">
			<div class="header-logo">
				<img src="images/icon.png" width="58" height="58">
			</div>
		</div>
	</header>
	
	<div class="hello"> </div>

	<div class="welcome">
		<div class="welcome-text"> 
			<div class="welcome-text-1">Добро пожаловать</div>
			<div class="welcome-text-2">на недружелюбную социальную сеть</div>
		</div>
		 <div class="welcome-hidden"></div>
	</div>
	<div class="index">
		<?php
			if(isset($_GET['conf'])){
				if ($_GET['type'] == 'good')
					echo "<div class = 'server-message good-server-message'>".$_GET['conf']."</div>";
				else
					echo "<div class = 'server-message bad-server-message'>".$_GET['conf']."</div>";
			} else {
				echo "<div class = 'server-message'></div>";
			}
		?>
	
	

		<div class="registration" id="registration">
			<div class="reg-info">
				<form action="Source/auth/registration.php" method="POST" name = 'registration' enctype="application/x-www-form-urlencoded">
				<div class="reg-email">
					<input type="email" name="email" class="reg-input" placeholder="Почта">
				</div>
				<div class="reg-firstname">
					<input type="text" name="firstname" class="reg-input" placeholder="Имя">
				</div>
				<div class="reg-lastname">
					<input type="text" name="lastname" class="reg-input" placeholder="Фамилия">
				</div>
				<div class="reg-pass">
					<input type="password" name="password" class="reg-input" placeholder="Пароль">
				</div>
				<div class="reg-repass">
					<input type="password" name="repassword" class="reg-input" placeholder="Повторите пароль">
				</div>
				<div class="reg-pers">
					<input type="checkbox" name="pers" class="pers-input" id='pers'>
					<label for="pers">Согласие на обработку персональных данных</label>					
				</div>
				</form>
				<div class="reg-button">
					<button  class="reg-submit" id="reg-button" onclick="authUser.sendRegistration();">Зарегестрироваться</button>
				</div>
				
			</div>
			
		</div>
		<div class="auth" id="auth">
			<div class="auth-form-div" id="auth-form-div">
				<form action="Source/auth/auth.php" method="POST" name = 'auth'>
					<div class="auth-login"> 
						<input type="email" name="email" class="reg-input" placeholder="Почта">
					</div>

					<div class="auth-pass">
						<input type="password" name="password" class="reg-input" placeholder="Пароль">
					</div>

				</div>	

					
				</form>
				<div class="auth-button">
					<button class="auth-submit" onclick="authUser.sendAuth();">Войти</button> 
				</div>
			<div class="reg-display">
				<button class="reg-display-button" id="reg-display-button" onclick="reg_display()">Регистрация</button>
			</div>
		</div>
	</div>
		
	
	<script>

		//window.onload = function() {
    		var authUser = new auth('not');
  		//};
		

	</script>
</body>
</html>