<?php 
	require "./connectDb.php";
	require "./sources/php/sessionInit.php";
	require "./checkUserAccess.php";
	
	checkUserAccess($db);
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php echo $title ?>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/861689887d.js" crossorigin="anonymous"></script>
	<style>
		body {
			margin: 0 auto;
		}
		.container {
			width: 80%;
		}
		.formView{
			width: 50%;
			margin: 15px;
			display: flex;
			flex-direction: column;
		}
		.pictures {
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			flex-wrap: wrap;
			width: 70%;
		}
		.picture {
			display: flex;
			flex-direction: column;
			align-items: center;
			color: #328625;
			border: solid #999999 1px;
			border-radius: 5px;
			padding: 10px 20px;
			margin: 10px;
		}
		.smallImg {
			width: 180px;
			margin: 15px;
		}
	</style>
</head>
<body>
<div class="body_container">
	<div class="header container">
	    <a href="index.php" class="logo">Bran<span>d</span></a>
		<div class="search--content">
			<form method="get" class="search">
				<input type="checkbox" name="Browse" id="Browse">
				<label  class="search__browse" for="Browse" id="buttonDropDownMenu">Browse <i class="fas fa-caret-down"></i></label>	
				<div class="search--menu" aria-labelledby="buttonDropDownMenu">
					<?php
						foreach($browseMenuItems as $head => $items) {
							echo "<h3>$head<h3><div class=\"greyLine\"></div>";
							foreach($items as $item) {
								echo "<a href=\"#\">$item</a><br>";
							}
						}
					?>
				</div>
				<input type="text" name="search" placeholder="Search for Item...">
				<button><i class="fas fa-search"></i></button>
			</form>
		</div>

		<div class="card--content">
			<input type="checkbox" name="header__cart_link" id="header__cart_link">
			<label for="header__cart_link" class="header__cart_link"><img src="img/cart.png" alt="cart" class="header__cart"></label>
			<div class="card-link--dropDown">
				
				<button id="checkout">Checkout</button>
				<a href="ShoppingCart.php">Go to cart</a>
			</div>
		</div>
		<button name="accountBar" class="header__account-bar"><a href="login.php">My Account <i class="fas fa-caret-down"></i></a></button>	
	</div>
	<h3><a href="orderList.php">Список всех заказов</a></h3>
	<form id="addProduct" class="formView" enctype="multipart/form-data" action="addProduct.php" method="POST">
		<h3>Добавление товара</h3>
		<label>Артикул товара</label>
		<input type="text" name="productCode" placeholder="Артикул товара">
		<label>Наименование товара</label>
		<input type="text" name="productName" placeholder="Наименование товара">
		<label>Описание товара</label>
		<input type="text" name="productDecription">
		<label>Цена товара</label>
		<input type="text" name="productPrice">
		<label>Количество товара</label>
		<input type="text" name="productQuantity">
		<label>Отображать товар на сайте</label>
		<input type="checkbox" name="activeProduct">
		<input type="hidden" name="MAX_FILE_SIZE" value="50000">
		<label>Изображение товара</label>
		<input type="file" name="productImg">
		<input type="submit" value="Добавить товар" name="addProduct">
	</form>
	<h2>Каталог товаров</h2>
	
	<!--<div>
		<p>Найти товар по артикулу</p>
		<input >
	</div>-->
	
	
	<h3>Все товары</h3>
	
	<div class="fetured_items__content pictures">
		
		<?php 
		$imgPath = "./img/product_img";

		$unload_result = mysqli_query($db, "SELECT * FROM product");
		if($unload_result){
			while($row = mysqli_fetch_assoc($unload_result)){
				echo "<div class=\"picture\"><img class=\"smallImg\" src=\"$imgPath/" . $row['img'] . "\" alt=\"" . $row['img'] . "\">
						<p>Наименование: " . $row['product_name'] . "</p>
						<p>Артикул: " . $row['product_code'] . "</p>
						<p>Количество: " . $row['product_quantity'] . "</p>
						<div>
							<p class=\"price\">&#36; " . $row['product_price'] . "</p>
						</div>
						<a href=\"toChangeProduct.php?id=" . $row['id'] . "\"><b>Редактировать</b></a>
						<a href=\"deleteProduct.php?id=" . $row['id'] . "\"><b>Удалить из базы</b></a>
					</div>";
			}
		}


		?>
	</div>






<script>
"use strict"

let myRequest = new XMLHttpRequest();
myRequest.open("POST", "addProduct.php");
console.log(myRequest);


</script>
</body>