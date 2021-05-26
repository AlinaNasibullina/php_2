<?php
require '../engine/Product.php';
require '../engine/Shoes.php';
$imgPath = "./img/product_img/";
$products = [
    new Product(12, "Футболка", 45, "Футболка мужская", "image_placeholder_1937.png", 2),
    new Shoes(15, "Туфли", 98, "Туфли женские классические черные", "product_21.png", 1),
];
foreach ($products as $product){
    echo "
        <div class=\"picture\"><img class=\"smallImg\" src=\"$imgPath" . $product->product_img . "\" alt=\"" . $product->product_img . "\">
            <p>Наименование: " . $product->product_name . "</p>
            <p>Категория: " . $product::$category . "</p>
            <p>Артикул: " . $product->product_code . "</p>
            <p>Количество: " . $product->product_quantity . "</p>
            <p>Описание: " . $product->product_description . "</p>
            <div>
                <p class=\"price\">Цена: &#36; " . $product->product_price . "</p>
            </div>
        </div>
        ";

}