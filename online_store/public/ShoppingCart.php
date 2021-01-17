<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";
$basket_session = $_COOKIE['basket_session'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/ShoppingCart.css">
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
	<main class="container cart-table">
		<div class="cart-table__head">											  											  
			<h3>Product Details</h3>
			<h3>unite Price</h3>
			<h3>Quantity</h3>
			<h3>shipping</h3>
			<h3>Subtotal</h3>
			<h3>ACTION</h3>
		</div>
		<?php 
			$imgPath = "./img/product_img";
			$user_id = $_SESSION["user_id"];
			if(!empty($user_id)){
				
				$result = mysqli_query($db, "SELECT * FROM baskets b LEFT JOIN basket_items i ON i.basket_id = b.id LEFT JOIN product p ON p.id = i.product_id WHERE user_id = $user_id ");
				if($result){
					$total_summ = 0;
					while($row = mysqli_fetch_assoc($result)){
						if(empty($row['basket_id'])){
							$del_basket_result = mysqli_query($db, "DELETE FROM baskets WHERE id = $" . $row['id'] . "");
						} else {
							$summ = $row['product_price'] * $row['product_count'];
							echo "<div class=\"product-details-row\">
									<div class=\"product-detail-column\">
										<img src=\"$imgPath/" . $row['img'] . "\" alt=\"" . $row['img'] . "\">
										<div class=\"product-details\">
											<p class=\"product-name\">" . $row['product_name'] . "</p>
											<p>Color:<span>Red</span><br>Size:<span>Xll</span></p>
										</div>
									</div>
									<p>$" . $row['product_price'] . "</p>
									<p>" . $row['product_count'] . "</p>
									<p>FREE</p>
									<p>$$summ</p>
									<a href=\"./deleteFromCard.php?id=" . $row['product_id'] . "\">X<i class=\"fas fa-times-circle\"></i></a>
								</div>";
							$total_summ = $total_summ + $summ;
						}
					}
				}
			} else {
				$result = mysqli_query($db, "SELECT * FROM baskets b LEFT JOIN basket_items i ON i.basket_id = b.id LEFT JOIN product p ON p.id = i.product_id WHERE basket_session = \"$basket_session\" AND user_id IS NULL ");
				if($result){
					$total_summ = 0;
					
					while($row = mysqli_fetch_assoc($result)){
						if(empty($row['basket_id'])){
							$del_basket_result = mysqli_query($db, "DELETE FROM baskets WHERE id = $" . $row['id'] . "");
						} else {
							$summ = $row['product_price'] * $row['product_count'];
							echo "<div class=\"product-details-row\">
									<div class=\"product-detail-column\">
										<img src=\"$imgPath/" . $row['img'] . "\" alt=\"" . $row['img'] . "\">
										<div class=\"product-details\">
											<p class=\"product-name\">" . $row['product_name'] . "</p>
											<p>Color:<span>Red</span><br>Size:<span>Xll</span></p>
										</div>
									</div>
									<p>$" . $row['product_price'] . "</p>
									<p>" . $row['product_count'] . "</p>
									<p>FREE</p>
									<p>$$summ</p>
									<a href=\"./deleteFromCard.php?id=" . $row['product_id'] . "\">X<i class=\"fas fa-times-circle\"></i></a>
								</div>";
							$total_summ = $total_summ + $summ;
						}
						
					}
				}
			}
		?>
		<div class="cart-table-button">
			<button class="clear_cart">cLEAR SHOPPING CART</button>
			<button class="continue_shopping">cONTINUE sHOPPING</button>
		</div> <!-- связать кнопки с таблицей-->
		<form class="Checkout" method="POST" action="myOrder.php">
			<div class="shippingAdress">
				<h3>Shipping Adress</h3>
				<select name="country">
					<option value="Bangladesh">Bangladesh</option>
					<option value="Russia">Russia</option>
				</select>
				<input type="text" placeholder="State" name="postAddress">
				<input type="text" placeholder="Postcode / Zip" name="postcode">
				<button>get a quote</button>
			</div>
			<div class="couponDiscount">
				<h3>coupon discount</h3>
				<p>Enter your coupon code if you have one</p>
				<input type="text" placeholder="State">
				<button>Apply coupon</button>
			</div>
			<div class="proceedCheckout">
				<p>Sub total      $<?php echo $total_summ ?></p>
				<p>GRAND TOTAL     <span>$<?php echo $total_summ ?></span></p>
				<hr>
				<!--<button>proceed to checkout</button>-->
				<input type="submit" name="proceed to checkout" value="proceed to checkout">
			</div>
		</form>
	</main>
</div>

<div class="crl"></div>
<div class="footer_block">
	<div class="endBanner">
	<div class="container endBanner__content">
		<div class="quote">
			<img src="img/photo_3_2206.png" alt="photo">
			<div class="quote__content">
				<p class="quote__text">“Vestibulum quis porttitor dui! Quisque viverra nunc mi, a pulvinar purus condimentum a. Aliquam condimentum mattis neque sed pretium”</p>
				<p class="quote__sign">Bin Burhan</p>
				<p class="quote__sity">Dhaka, Bd</p>
				<a href="#" class="quote__slider"></a>
				<a href="#" class="quote__slider quote__slider_active"></a>
				<a href="#" class="quote__slider"></a>
			</div>
		</div>
		<div class="subscribe">
			<h3>Subscribe</h3>
			<p>FOR OUR NEWLETTER AND PROMOTION</p>	
			<form action="#" class="subscribe-form">
				<input type="email" placeholder="Enter Your Email"><button>Subscribe</button>
			</form>
		</div>
	</div>
	</div>
	<footer class="container footer__info">
		<div class="footer__text">
			<div class="logo">Bran<span>d</span></div>
			<p>Objectively transition extensive data rather than cross functional solutions. Monotonectally syndicate multidisciplinary materials before go forward benefits. Intrinsicly syndicate an expanded array of processes and cross-unit partnerships.<br><br>Efficiently plagiarize 24/365 action items and focused infomediaries.Distinctively seize superior initiatives for wireless technologies. Dynamically optimize.
			</p>
		</div>
		<div class="footer__content">
			<h3>COMPANY</h3>
			<a href="#">Home</a>
			<a href="#">Shop</a>
			<a href="#">About</a>
			<a href="#">How It Works</a>
			<a href="#">Contact</a>
		</div>
		<div class="footer__content">
			<h3>INFORMATION</h3>
			<a href="#">Tearms &amp; Condition</a>
			<a href="#">Privacy Policy</a>
			<a href="#">How to Buy</a>
			<a href="#">How to Sell</a>
			<a href="#">Promotion</a>
		</div>
		<div class="footer__content">
			<h3>SHOP CATEGORY</h3>
			<a href="#">Men</a>
			<a href="#">Women</a>
			<a href="#">Child</a>
			<a href="#">Apparel</a>
			<a href="#">Brows All</a>
		</div>
	</footer>
	<footer class="end-line">
		<div class="container footer-end-line">
			<p>&copy; 2017 Brand All Rights Reserved.</p>
			<div class="social-link">
			<a href="#"><i class="fab fa-facebook-f"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-linkedin-in"></i></a>
			<a href="#"><i class="fab fa-pinterest-p"></i></a>
			<a href="#"><i class="fab fa-google-plus-g"></i></a></div>
		</div>
	</footer>
</div>

</body>
</html>