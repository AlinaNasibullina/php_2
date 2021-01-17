<?php
	require "./connectDb.php";
	require "./sources/php/sessionInit.php";
	$h1_head = "<h1>THE BRAND</h1>";
	$title = "<title>Brand shop</title>";
	$current_year = date("Y");
	$browseMenuItems = [
		"Women" => ["Dresses","Tops","Sweaters/Knits","Jackets/Coats","Blazers","Denim","Leggings/Pants","Skirts/Shorts","Accessories"],
		"Men" => ["Tees/Tank tops", "Shirts/Polos", "Sweaters", "Sweatshirts/Hoodies", "Blazers", "Jackets/vests"],
	];
	if(!empty($_SESSION['user_name'])){
		header("Location: personalAccount.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php echo $title ?>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/861689887d.js" crossorigin="anonymous"></script>
	
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
				<div class="greyLine"></div>
				<div>
					<p>TOTAL</p>
					<p>$500.00</p>
				</div>
				<button id="checkout">Checkout</button>
				<a href="ShoppingCart.php">Go to cart</a>
			</div>
		</div>
		<button name="accountBar" class="header__account-bar"><a href="login.php">My Account <i class="fas fa-caret-down"></i></a></button>	
	</div>

	<div class="headerLine"></div>

<form name="authentication" method="POST" action="toLogin.php">
	<h3>Форма аутентификации</h3>
	<lable>Введите имя пользователя</lable>
	<input type="text" name="userName" placeholder="Иванов Иван">
	<lable>Введите пароль</lable>
	<input type="password" name="userPassword" placeholder="Какой-то пароль">
	<input type="submit" value="Войти">
</form>
<p>Если у вас еще нет личного кабинета, можете зарегистрироваться в поле ниже</p>
<form name="registration" method="POST" action="toRegistration.php">
	<h3>Форма регистрации пользователя</h3>
	<label>Введите логин *</label>
	<input type="text" name="userName">
	<label>Введите полное имя</label>
	<input type="text" name="userFullName">
	<label>Введите пароль *</label>
	<input type="password" name="userPassword" id="newUserPassword">
	<label>Повторите пароль *</label>
	<input type="password" name="userPasswordRepeat" id="newUserPasswordRepeat">
	<input type="submit" value="Зарегестрироваться" name="toRegistration" id="toRegistration">
</form>
<p>Перейти на <a href="./index.php">главную страницу</a></p>

</div>

<script>
"use strict";
//TODO сделать проверку совпадения паролей
let reg_button = document.querySelector("#toRegistration");
let newUserPassword = document.querySelector("#newUserPassword");
let newUserPasswordRepeat = document.querySelector("#newUserPasswordRepeat");


</script>
</body>
</html>