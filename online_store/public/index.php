<?php
	require "./connectDb.php";
	require "./sources/php/sessionInit.php";
	require "./settingCookie.php";
	$h1_head = "<h1>THE BRAND</h1>";
	$title = "<title>Brand shop</title>";
	$current_year = date("Y");
	$browseMenuItems = [
		"Women" => ["Dresses","Tops","Sweaters/Knits","Jackets/Coats","Blazers","Denim","Leggings/Pants","Skirts/Shorts","Accessories"],
		"Men" => ["Tees/Tank tops", "Shirts/Polos", "Sweaters", "Sweatshirts/Hoodies", "Blazers", "Jackets/vests"],
	]
	
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
	<div class="topBanner">
	    <div class="container">
	    	<div class="topBanner__content">
	    		<div class="redLine"></div>
				<div class="topBanner__text">
					<?php echo $h1_head ?>
					<h2>OF LUXERIOUS <span>FASHION</span></h2>
				</div>
	    	</div>
	    </div>
	</div>
	<div class="container range__content">
		<div class="range">
			<a href="#" class="range__link"><div class="range__text">hOT dEAL<br><span>FOR MEN</span></div><img src="img/offer1.jpg" alt="offer1">
			</a>
		</div>
		<div class="range">
			<a href="#" class="range__link"><div class="range__text">LUXIROUS &amp; trendy<br><span>ACCESORIES</span></div><img src="img/offer2.jpg" alt="offer2"></a>
		</div>
		<div class="range">
			<a href="#" class="range__link"><div class="range__text">30% offer<br><span>women</span></div><img src="img/offer3.jpg" alt="offer3"></a>
		</div>
		<div class="range">
			<a href="#" class="range__link"><div class="range__text">new arrivals <br><span>FOR kids</span></div><img src="img/offer4.jpg" alt="offer4"></a>
		</div>
	</div>
	<div class="container fetured__box">
		<h3 class="fetured_items__h3">Fetured Items</h3>
		<p class="fetured_items__span">Shop for items based on what we featured in this week</p>
		<!--<div class="modalBlock"><?php /*echo $_SESSION['message'];*/?></div>-->
		<div class="fetured_items__content">
			
			<?php 
				$imgPath = "./img/product_img";

				$unload_result = mysqli_query($db, "SELECT * FROM product WHERE active = 1");
				if($unload_result){
					while($row = mysqli_fetch_assoc($unload_result)){
						echo "<a class=\"fetured_items__link\" id=\"" . $row['id'] . "\"><div class=\"hover_cart\"><form method=\"POST\" action=\"addToCard.php\"><input type=\"submit\" value=\"Add to Cart\"><input type=\"hidden\" name=\"productId\" value=\"" . $row['id'] . "\"></form></div><img src=\"$imgPath/" . $row['img'] . "\" alt=\"" . $row['img'] . "\">
								<p>" . $row['product_name'] . "</p>
								<div>
									<p class=\"price\">&#36;" . $row['product_price'] . "</p>
									<p><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i><i class=\"fas fa-star\"></i></p>
								</div></a>";
					}
				}?>
		</div>
	    <button name="AllProdict" class="browseAllProduct">Browse All Product <i class="fas fa-long-arrow-alt-right"></i></button>
	</div>
	<div class="container only_offer">
		<div class="offer__banner">
			<h2 class="offer_h2">30% <span>OFFER</span></h2>
			<p>FOR WOMEN</p>
		</div>
		<div class="offer__content">
			<div class="offer__details offer__details1">
				<h3>Free Delivery</h3>
				<p>Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive models.</p>
			</div>
			<div class="offer__details">
				<h3>Sales &amp; discounts</h3>
				<p>Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive models.</p>
			</div>
			<div class="offer__details">
				<h3>Quality assurance</h3>
				<p>Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive models.</p>
			</div>
		</div>
	</div>
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
			<p>&copy; <?php echo $current_year ?> Brand All Rights Reserved.</p>
			<a href="../admin.php">Admin</a>
			<div class="social-link">
			<a href="#"><i class="fab fa-facebook-f"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-linkedin-in"></i></a>
			<a href="#"><i class="fab fa-pinterest-p"></i></a>
			<a href="#"><i class="fab fa-google-plus-g"></i></a></div>
		</div>
	</footer>
</div>


<!--<script src="./sources/js/addToCard.js"></script>-->
<script>
"use strict";

let modalBlock = document.querySelector(".modalBlock");

setTimeout(hideMessage, 3000, modalBlock);

function hideMessage(node){
	node.style.opacity = 0;
}

</script>
</body>
</html>