<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";


$productId = (int)$_POST['productId'];
$user_id = $_SESSION['user_id'];
$pre_page = $_SERVER[HTTP_REFERER];
$value_b = "b" . $user_id . time(); 
$basket_session = $_COOKIE["basket_session"];
$select_basket_sql = "SELECT * FROM baskets WHERE basket_session = \"$basket_session\"";
$select_user_basket_sql = "SELECT * FROM baskets WHERE user_id = $user_id";
$add_basket_sql = "INSERT INTO baskets (basket_session) VALUES (\"$basket_session\")"; 
$add_user_basket_sql = "INSERT INTO baskets (user_id) VALUES ($user_id)"; 
//$add_change_prod_sql = "INSERT INTO basket_items (basket_id, product_id, product_count) VALUE ({$basket_id}, {$productId}, 1) ON DUPLICATE KEY UPDATE product_count = product_count + 1"; /*текст запроса на добавление товара в корзину*/

if(!empty($user_id)){
	/*если пользователь залогинен, проверяем наличие корзины*/
	$result = mysqli_query($db, $select_user_basket_sql);
	if($result){
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt == 0){
			/*создаем корзину*/
			$make_result = mysqli_query($db, $add_basket_sql);
		}
	}
} else {
	/*если пользователь не залогинен, проверяем наличие куки для корзины, если нет, создаем*/
	if(is_null($basket_session)){
		setcookie("basket_session", $value_b, time() + 360*24*7, "/", "testsite");
		$basket_session = $_COOKIE["basket_session"];
		header ("Location: addToCard.php");
	} else {
		$result = mysqli_query($db, $select_basket_sql);
		if($result){
			$row_cnt = mysqli_num_rows($result);
			if($row_cnt == 0){
				/*создаем корзину без пользователя*/
				$make_result = mysqli_query($db, $add_basket_sql);
			}	
		}
	}
}
$row = mysqli_fetch_assoc($result);
$basket_id = $row['id'];
//$add_result = mysqli_query($db, $add_change_prod_sql); //не работает, вероятно потому, что $basket_id определен только в условии.
$add_result = mysqli_query($db, "INSERT INTO basket_items (basket_id, product_id, product_count) VALUES ({$basket_id}, {$productId}, 1) ON DUPLICATE KEY UPDATE product_count = product_count + 1");

if($add_result){
	$_SESSION['message'] = "Товар добавлен в корзину";
	header("Location: $pre_page#$productId");
} else {
	$_SESSION['message'] = "Не удалось добавить товар в корзину";
	header("Location: $pre_page#$productId");
}



