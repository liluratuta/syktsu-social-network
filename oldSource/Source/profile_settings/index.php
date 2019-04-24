<?php 
    if(session_id() == '') {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Setting</title>
	<link rel="stylesheet" href="css/setting_style.css" type="text/css">
</head>
<body>
    <?php
        require_once("connection_bd.php");
    ?>
<div class="header">
    <h3 class="title" align="center">Настройки пользователя</h3>
</div>

<div class="fixedblock">

 <div class="block">
 <label class="block-label"><h4 class="title" align="left">Изменение аватаров профиля:</h4></label>
 	<input class="block-text" type="text" size="45" id="PositiveAvatar" for="Positive" placeholder="Введите ссылку на ваш позитивный аватар"> 
 	<br>
    <input class="block-button" type="submit" onclick="PositiveAvatar()" id="Positive" value="Изменить"  />
    <br>
	<input class="block-text" type="text" size="45" id="NegativeAvatar" for="Negative" placeholder="Введите ссылку на ваш грустный аватар"> 
	<br>
    <input class="block-button" type="submit" onclick="NegativeAvatar()" id="Negative" value="Изменить"  />
 </div>

    <?php
        require_once("form_redactor_name.php");
        require_once("form_redactor_password.php");
    ?>
    <div>
    <label class="block-label"><h4 class="title" align="left">Изменить шапку профиля</h4></label>
    <?php
        require_once("form_redactor_image_header.php");
        require_once("form_upload_image_header.php");
    ?>
    </div>
<form action="logout.php">
    <input class="block-button" type="submit" name="logout" value="Выйти">
</form>
</body>
</html>
