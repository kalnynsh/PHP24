<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
 <meta http-equiv="x-ua-compatible" content="ie=edge">
<title>PHP</title>
<meta name="description" content="education">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="/images/icon.png">
<link rel="stylesheet" href="/css/normalize.css">
<link rel="stylesheet" href="/css/app.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous" defer></script>
<script src="/js/app.js" defer></script>
</head>
<body>
    <div class="wrap">   
        <header class="main-header">
        <nav>
        <ul class="menu1">
            <li class="menu1__item">
                <a href="/index.php">Главная</a>
            </li>          
            <li class="menu1__item">
                <a href="/comments/index">Оставить комментарий</a>
            </li>
            <li class="menu1__item">
                <a href="/register/index">Регистрация</a>
            </li>
            <li class="menu1__item">
                <a href="/login/index">Вход</a>
            </li>
            <li class="menu1__item">
                <a href="/logout/index">Выход</a>
            </li>
            <li class="menu1__item">
                <a href="/cart/index">Личный кабинет</a>
            </li>                                    
            <!-- <li class="menu1__item">
                <a href="admin.php">Админ панель</a>
            </li>               -->
        </ul>
        </nav>
        </header>
        <div class="container">            
                <?php echo $content ? : ''; ?>            
        </div>
        <footer>
            <div class="footer">            
                Kalnynsh <?php echo date('Y'); ?>
            </div>        
        </footer>
    </div>
</body>
</html>
