<?php

require "./connectDb.php";
require "./sources/php/sessionInit.php";
$basket_session = $_COOKIE['basket_session'];

$productId = $_GET['id'];
$pre_page = $_SERVER[HTTP_REFERER];
$user_id = $_SESSION['user_id'];
if(!empty($user_id)){
	$result = mysqli_query($db, "DELETE FROM basket_items WHERE basket_id = (SELECT id FROM baskets WHERE user_id = $user_id) AND product_id = $productId");
	if($result){
		$_SESSION['message'] = "товар удален";
		header("Location: $pre_page");
	}else{
		echo mysqli_error($db);
	}
	
} else {
	$result = mysqli_query($db, "DELETE FROM basket_items WHERE basket_id = (SELECT id FROM baskets WHERE basket_session = \"$basket_session\" AND user_id IS NULL) AND product_id = $productId");
	if($result){
		$_SESSION['message'] = "товар удален";
		header("Location: $pre_page");
	}else{
		echo "2";
		echo mysqli_error($db);
	}
}
