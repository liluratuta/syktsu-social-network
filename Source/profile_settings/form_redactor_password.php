<form id = 'password_form' action="redactor_password.php" method="POST">
    <label class="block-label"><h4 class="title" align="left">Изменение пароля:</h4></label>

    <input class="block-text" name="password" type="password"  size="45" id="password" placeholder="Введите старый пароль"> <br>
    <input class="block-text" name="newpassword" type="password"  size="45" id="newpassword" placeholder="Введите новый пароль" onkeyup="checknewpass(); return false;"> <br>

    <input class="block-text" name="repeatnewpassword" type="password" size="45" id="repeatnewpassword" placeholder="Повторите новый пароль" onkeyup="checknewpass(); return false;"> <br>

    <input class="block-button" type="submit" value="Изменить пароль">
    <div id="error-nwl"></div>
</form>

<script>
    function checknewpass()
{
    var pass1 = document.getElementById('newpassword');
    var pass2 = document.getElementById('repeatnewpassword');
    var message = document.getElementById('error-nwl');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    
    if(pass1.value.length > 5)
    {
        pass1.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Верно!"
    }
    else
    {
        pass1.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Пароль должен содержать не менее 6 символов!"
        return;
    }

    if(pass1.value == pass2.value)
    {
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
    }
    else
    {
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Пароль не совпадают!"
    }
}
</script>

<div class="block">
 	<input class="block-button" type="submit" onclick="DeleteAccount()" name="Al1" value="Удалить аккаунт"  />
</div>