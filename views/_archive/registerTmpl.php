<form action="register.php" method="post">
    <div class="form-inputs">
        Введите имя:<input name="user_name" type="text"/>
    </div>    
    <div class="form-inputs">
        Введите логин:<input name="user_login" type="text"/>
    </div>
    <div class="form-inputs">
        Введите пароль: <input name="user_password" type="password"/>
    </div>
    <div class="form-inputs">
        <input name="submit_register" value="Зарегистрироваться" type="submit"/>
    </div>
</form>

<div><?php print $message ? : ''; ?></div>
