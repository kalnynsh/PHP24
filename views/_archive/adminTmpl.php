<form action="admin.php" method="POST">
    <label> Название товара: 
    <input type="text" name="product-name" placeholder="Брюки классические">
    </label><br><br>
    <label>
    Категория:     
    <select name="categoryID">
         <option value="1">Брюки</option>
         <option value="2">Рубашки</option>
         <option value="3">Футболки</option>
         <option value="4">Нижнее белье</option>
         <option value="5">Костюмы</option>
         <option value="6">Куртки</option> 
         <option value="7">Пальто</option>                                            
    </select>    
    </label><br><br>    
    <label>
    Цвет: 
    <input type="text" name="color" placeholder="черный">    
    </label><br><br>
    <label>
    Материал: 
    <input type="text" name="material" placeholder="Хлопок">    
    </label><br><br>
    <label>
    Размер: 
    <input type="text" name="size" placeholder="48">    
    </label><br><br>    
    Цена: 
    <input type="text" name="price" placeholder="4500">    
    </label><br><br>
    Имеющиеся количество: 
    <input type="text" name="amount" placeholder="10">    
    </label><br><br>       
    <input type="file" name="photo" value="Загрузить фото товара" 
        formenctype="multipart/form-data" 
        accept="image/jpeg,image/png,image/gif,image/jpg">
    <input type="submit"  value="Загрузить фото товара"><br><br>
    <input type="submit" value="Загрузить в БД"><br><br>
</form>

