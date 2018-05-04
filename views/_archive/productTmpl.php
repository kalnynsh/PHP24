<div class="product-content">
    <img src="<?php echo $path; ?>" alt="image" width="70%">
    <div class="product-description-cart">
        <div>
            <p><?php echo $product['product_name']; ?></p>
            <p><?php echo $product['color']; ?></p>
            <p>Цена: <?php echo $product['price']; ?> руб.</p>
        </div>
        <?php if ($is_login) : ?>
            <div class="product-addtocart">                
                    <input type="hidden" name="id" 
                        value="<?php echo $product['id_product']; ?>">
                    <input type="number" name="amount" value="1" range="1-100">
                    <input type="submit" name="submit_add_to_cart" 
                        class="add-to-cart"                        
                       value="Добавить в корзину">  
                    <input type="submit" name="submit_edit_cart"
                        class="edit_cart"
                        value="Изменить содержимое корзины">                
            </div>
        <?php endif; ?>
    </div>
</div>
