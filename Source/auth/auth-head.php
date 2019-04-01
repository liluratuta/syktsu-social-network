<!-- хидер сайта(присутствует во всех документах) -->
<link rel="stylesheet" type="text/css" href="css/auth.css"> 
<script type="text/javascript">
    function cancelauth(){
    if(log.hasAttribute('hidden')) {
        log.removeAttribute('hidden');
        lern.innerHTML = 'Отмена';}
    else {
        log.setAttribute('hidden','');
        lern.innerHTML = 'Войти';
    }
}

</script>
<div class = "forheader">
<?php 
require_once 'auth-class.php';
if ($auth->isAuth()) {
    echo "Здравствуйте, " . $auth->get_name()['firstname'];
    echo " <a href=\"?is_exit=1\">Выйти</a>";
     } 
     else {
     	echo "Здравствуйте, Гость";
     	echo " <button class ='but' style = 'width:75px;' id = 'lern' onclick = 'cancelauth();'>Войти</button>";
     }
?>


</div>
<div id = 'log' class = 'auth-head' hidden>
<form method="post" action="">
   <div align="right"> Логин:  <input style = 'right:30px;' type="text" name="login" value="<?php echo (isset($_POST["login"])) ? $_POST["login"] : null; // Заполняем поле по умолчанию ?>" /><br></div>
    Пароль: <input type="password" name="password" value="" /><br/>
    <input class="but" type="submit" style="width:75px" value="OK">
</form>
</div>