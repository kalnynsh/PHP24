<div class="products">      
    <div class="products__item">
        <img width="100%" 
            src="/images/products/<?php echo 'item-2' . $product->image_id . '.jpg'; ?>" 
                alt="image">
        <div class="product-description">
            <p>
                <?php echo $product->product_name; ?>
                <?php echo $product->color; ?>
            </p>
            <p>Цена: <?php echo $product->price; ?> руб.</p>
            <p>Количество: <?php echo $product->amount; ?> шт.</p>
        </div>
        <?php if ($is_login) : ?>
            <form name="addtocart" action="?c=cart&a=add"
                class="product-addtocart" 
                method="POST">                
                    <input type="hidden" name="id" 
                        value="<?php echo $product->id; ?>">
                    <input type="number" name="amount" value="1" range="1-100">
                    <input type="submit" name="submit_add_to_cart" 
                        class="add-to-cart"                        
                    value="Добавить в корзину">  
                    <input type="submit" name="submit_edit_cart"
                        class="edit_cart"
                        value="Изменить содержимое корзины">                
            </form>
        <?php endif; ?>  
    </div>
</div>
