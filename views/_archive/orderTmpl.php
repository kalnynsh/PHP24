<div class="greeting">
    <?php if ($username) : ?>
        <p>Ваша корзина <?php echo $username; ?></p>
        <p>Номер Вашего Заказа: <?php echo $orderNumber; ?></p>
        <p>Спасибо за покупки!</p>
    <?php else : ?>
        <div>
            <a href="/login.php">Вход</a> 
        </div>
    <?php endif; ?>
</div>
<div class="buy">
    <button>
        <a href="index.php">Продолжить выбор</a>
    </button>
    <button>
        <a href="#">Выйти</a>
    </button>
</div>
