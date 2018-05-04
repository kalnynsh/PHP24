<div class="greeting">
    <?php if ($username) : ?>
        <p>Ваша корзина <?php echo $username; ?></p>
        <p>Общая стоимость: <?php echo $cartSum; ?> руб.</p>
    <?php else : ?>
        <div>
            Вы не вошли в свой личный кабинет <a href="/login.php">Вход</a> 
        </div>
    <?php endif; ?>
</div>
<div class="products">
    <?php if (count($products)) : ?>
        <?php foreach ($products as $product) : ?>        
            <div class="products__item">
                <a href="/product.php?id=<?php echo $product['id_product']; ?>">
                <img width="200" 
                        src="/images/products_small/<?php echo $product['image_name']; ?>" 
                            alt="image">
                    <div class="product-description">
                        <p>
                            <?php echo $product['product_name']; ?>
                            <?php echo $product['color']; ?>
                        </p>
                        <p>Цена: <?php echo $product['price']; ?> руб.</p>
                        <p>Количество: <?php echo $product['amount']; ?> шт.</p>
                    </div>
                </a>
            </div>     
        <?php endforeach; ?>
    <?php else : ?>
        <div>
            <p>Ваша корзина пуста</p>
        </div>
    <?php endif; ?>
</div>
<div class="buy">
    <button>
        <a href="/index.php">Продолжить выбор</a>
    </button>
    <button>
        <a href="/order.php">Оформить покупки</a>
    </button>
    <button>
        <a href="/login.php">Войти</a>
    </button>
    <button>
        <a href="/logout.php">Выйти</a>
    </button>
</div>
