<?php 
require "./connectDb.php";
require "./sources/php/sessionInit.php";
$basket_session = $_COOKIE['basket_session'];
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/ShoppingCart.css">
    <script src="https://kit.fontawesome.com/861689887d.js" crossorigin="anonymous"></script>
	<style>
		.orderDetails {
			margin: 30px;
			width: 50%;
			display: flex;
			flex-direction: column;
		}
		.product_details {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
		}
		.greyLine {
		  width: 100%;
		  height: 1px;
		  background-color: #ededed;
		  margin: 0.5em 0;
		}
		.confirmBlock {
			display: flex;
			flex-direction: column;
		}
		#orderPay {
			margin: 20px 0;
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

	<div class="headerLine"></div>

	<nav class="topNav">
		<div class="topNav__list"><a href="#">Home</a>
			<div class="navLine"></div>
		</div>
	    <div class="topNav__list"><a href="#">Man</a>
			<div class="topNav--dropDown">
			</div>
			<div class="navLine"></div>
		</div>
		<div class="topNav__list"><a href="#">Women</a>
			<div class="navLine"></div>
			<div class="topNav--dropDown">
			</div>
		</div>
	    <div class="topNav__list"><a href="#">Kids</a>
			<div class="navLine"></div>
		</div>
	    <div class="topNav__list"><a href="#">Accoseriese</a>
			<div class="navLine"></div>
		</div>
	    <div class="topNav__list"><a href="#">Featured</a>
			<div class="navLine"></div>
		</div>
	    <div class="topNav__list"><a href="#">Hot Deals </a>
			<div class="navLine"></div>
		</div>
	</nav>
	<div class="cart-head">
		<div class="container cart-head-content">
			<h1>New Arrivals</h1>
			<p>Home / Men / <span>New Arrivals</span></p>
		</div>
	</div>
<?php 
$user_address = $_POST['postcode'] . ", " . $_POST['country'] . ", " . $_POST['postAddress'];
$basket_result = mysqli_query($db, "SELECT * FROM baskets b LEFT JOIN basket_items i ON i.basket_id = b.id LEFT JOIN product p ON p.id = i.product_id WHERE user_id = $user_id ");
if(!$basket_result){
	echo "Ошибка загрузки корзины";
}
$check_result = mysqli_query($db, "SELECT * FROM orders WHERE user_id = $user_id AND order_state = 1");
if($check_result) {
	$row_cnt = mysqli_num_rows($check_result);
	$row = mysqli_fetch_assoc($check_result);
	if(!$row_cnt == 0){
		$clean_result = mysqli_query($db, "DELETE FROM order_list WHERE order_id = " . $row['id'] . "");
	} else {
		$add_ord_result = mysqli_query($db, "INSERT INTO orders (user_id, order_state, create_date) VALUES ($user_id, 1, \"" . date("Y-m-d H:i:s") . "\")");
		if($add_ord_result){
			$check_result = mysqli_query($db, "SELECT * FROM orders WHERE user_id = $user_id AND order_state = 1");
			if($check_result){
				$row = mysqli_fetch_assoc($check_result);
			}
		}
	}
	$order_id = $row['id'];
	$subtotal_sum = 0;
	$total_sum = 0;
	while($basket_row = mysqli_fetch_assoc($basket_result)){
		$basket_id = $basket_row['basket_id'];
		$subtotal_sum = $basket_row['product_price'] * $basket_row['product_count'];
		$total_sum = $total_sum + $subtotal_sum;
		$add_result = mysqli_query($db, "INSERT INTO order_list 
			(order_id, product_id, product_count, product_price, subtotal_sum) 
			VALUES ($order_id, " . $basket_row['product_id'] . "," . $basket_row['product_count'] . ", " . $basket_row['product_price'] . ", $subtotal_sum)"
		);
	}
	$add_total_result = mysqli_query($db, "INSERT INTO order_list
		(order_id, total_sum, user_address)
		VALUES ($order_id, $total_sum, \"$user_address\")"
	);
}
$result = mysqli_query($db, "SELECT l.order_id, l.product_id, l.product_count, l.product_price, l.subtotal_sum, l.total_sum, l.user_address, p.product_name, p.img 
					FROM orders o 
					LEFT JOIN order_list l ON l.order_id = o.id 
					LEFT JOIN product p ON p.id = l.product_id 
					WHERE user_id = $user_id AND order_state = 1");

?>
<div class="orderDetails">
<h3>Детали заказа № <?php echo $order_id?></h3>
	<div class="product_details">
		<p>Наименование товара: цена * количество</p>
		<p>Итого</p>
	</div>
	<div class="greyLine"></div>
	<?php
		while($row = mysqli_fetch_assoc($result)){
			if(!empty($row['product_id'])){
				echo "
					<div class=\"product_details\">
						<p>" . $row['product_name'] . ", $" . $row['product_price'] . " x " . $row['product_count'] . "</p>
						<p>" . $row['subtotal_sum'] . "</p>
					</div>
				";
			} else {
				echo "
					<div class=\"greyLine\"></div>
					<div class=\"product_details\">
						<p>Итоговая сумма: " . $row['total_sum'] . "</p>
						<p>Адрес доставки: " . $row['user_address'] . "</p>
					</div>
				";
			}
		}
	?>
	<div class="greyLine"></div>
	<div class="confirmBlock">
		<p>Пожалуйста, внимательно проверьте детали заказа перед оплатой</p>
		<p>Если необходимо внести изменения, вы можете <a href="ShoppingCart.php">Вернуться в корзину</a></p>
		<a href="ShoppingCart.php">Вернуться в корзину</a>
		<form method="POST" action="toPay.php" name="orderPay" id="orderPay">
			<input type="hidden" name="orderId" value="<?php echo $order_id;?>">
			<input type="hidden" name="totalSum" value="<?php echo $total_sum;?>">
			<input type="hidden" name="basketId" value="<?php echo $basket_id;?>">
			<input type="submit" value="Оплатить">
		</form>
	</div>

</div>
</div>

</body>
</html>