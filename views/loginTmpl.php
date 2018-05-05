<form action="/index.php/user/login" method="post" name="login-form">
    <div class="form-inputs">
        Логин:<input name="user_login" type="text"/>
    </div>
    <div class="form-inputs">
        Пароль: <input name="user_password" type="password"/>
    </div>
    <div class="form-inputs">
        <input name="sumbit_login" value="Войти" type="submit"/>
    </div>
</form>

<div><?php echo $message ? : ''; ?></div>
