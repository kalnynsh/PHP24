<div class="greeting">
    <?php if ($username) : ?>
        <p>Ваша корзина <?php echo $username; ?></p>
        <?php if (count($products)) : ?>
            <p>Общая стоимость: <?php print $cartSum ?? ''; ?> руб.</p>
        <?php endif; ?>
    <?php else : ?>
        <div>
            Вы не вошли в свой личный кабинет 
            <a href="/index.php/user/login">
                Вход
            </a>
        </div>
    <?php endif; ?>
</div>
<div class="products">
    <?php if (count($products)) : ?>
        <?php foreach ($products as $productId => $product) : ?>        
            <div class="products__item">
                <a href="/product.php?id=<?php echo $productId; ?>">
                <img width="200" 
                        src="/images/products_small/<?php 
                                                    echo 'item-2' . $productId . '.jpg';
                                                    ?>" 
                            alt="image">
                    <div class="product-description">
                        <p>
                            <?php echo $product[0]->product_name; ?>
                            <?php echo $product[0]->color; ?>
                        </p>
                        <p>Цена: <?php echo $product[0]->price; ?> руб.</p>
                        <p>Количество: <?php echo $product[1]; ?> шт.</p>
                        <p>Подитог: <?php echo $product[2]; ?> руб.</p>
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
        <a href="/index.php/order/index">Оформить покупки</a>
    </button>
    <button>
        <a href="/index.php/user/login">Войти</a>
    </button>
    <button>
        <a href="/index.php/user/logout">Выйти</a>
    </button>
</div>
