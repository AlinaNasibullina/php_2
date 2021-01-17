<?php
require "./connectDb.php";
require "./sessionInit.php";


$session_id = $_COOKIE['PHPSESSID'];
$product_id = $_POST['id'];

//var_dump($_POST);
//var_dump($product_id);
//echo ($session_id);
$result = mysqli_query($db, "SELECT * FROM baskets WHERE session_id = $session_id"); /*добавить OR user_id = $user_id и переменную $user_id (после авторизации)*/
var_dump($result);
if($result){
	$row_cnt = mysqli_num_rows($result);
	if($row_cnt == 0){
		$basket_result = mysqli_query($db, "INSERT INTO baskets (session_id) VALUE ({$session_id})");/*добавить user_id в запрос*/
		if($basket_result){
			$result = mysqli_query($db, "SELECT * FROM baskets WHERE session_id = $session_id"); /*добавить OR user_id = $user_id и переменную $user_id (после авторизации)*/
			return $result;
		}
	}
	$row = mysqli_fetch_assoc($result);
	$basket_id = $row['id'];
	$order_result = mysqli_query($db, "INSERT INTO orders (basket_id, product_id, product_count) VALUE ({$basket_id}, {$product_id}, 1) ON DUPLICATE KEY UPDATE product_count = product_count + 1");

}else{
	echo "не удалось добавить товар";
}



//var_dump ($_POST);
//var_dump ($_SESSION);