<div class="greeting">
    <?php if ($username) : ?>
        <p>Ваша корзина <?php echo $username; ?></p>
        <p>Номер Вашего Заказа: <?php echo $orderNumber; ?></p>
        <p>Спасибо за покупки!</p>
    <?php else : ?>
        <div>
            <a href="/index.php/user/login">Вход</a> 
        </div>
    <?php endif; ?>
</div>
<div class="buy">
    <button>
        <a href="/index.php">Продолжить выбор</a>
    </button>
    <button>
        <a href="/index.php/user/logout">Выйти</a>
    </button>
</div>
