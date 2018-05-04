<div class="greeting">
    <?php if ($username) : ?>
        Добро пожаловать <?php echo ucfirst(($username)); ?>!
    <?php endif; ?>
</div>
<div class="products">
    <?php foreach ($products as $product) : ?>        
        <div class="products__item">
            <a href="/product/card/<?php echo $product->id; ?>">
                <img width="200" 
                    src="/images/products_small/<?php echo 'item-2' . $product->image_id . '.jpg'; ?>" 
                    alt="image">
                <div class="product-description">
                    <p><?php echo $product->product_name; ?></p>
                    <p><?php echo $product->color; ?></p>
                    <p>Цена: <?php echo $product->price; ?>руб.</p>
                </div>
            </a>
        </div>               
    <?php endforeach; ?>
</div>
