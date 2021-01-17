<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";
$basket_session = $_COOKIE['basket_session'];
$user_id = $_SESSION['user_id'];
$order_id = $_POST['orderId'];
$total_sum = $_POST['totalSum'];
$basket_id = $_POST['basketId'];

/*заглушка оплаты*/

$pay_result = mysqli_query($db, "UPDATE orders SET order_state = 3, pay_date = \"" . date("Y-m-d H:i:s") . "\" WHERE id = $order_id");
if($pay_result){
	$result = mysqli_query($db, "DELETE FROM baskets WHERE id = $basket_id");
	if($result){
		$_SESSION["message"] = "Оплата прошла успешно, заказ оформлен";
		header ("Location: ShoppingCart.php");
	}
}else{
	echo "оплата не удалась";
}