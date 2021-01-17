<?php 
require "./connectDb.php";
require "./sources/php/sessionInit.php";

$basket_session = $_COOKIE['basket_session'];
$user_name = strip_tags(htmlspecialchars($_POST['userName'], ENT_QUOTES));
$user_password = strip_tags(htmlspecialchars($_POST['userPassword'], ENT_QUOTES));

$result = mysqli_query($db, "SELECT * FROM users WHERE user_name = \"$user_name\"");
if($result){
	$row = mysqli_fetch_assoc($result);
	if($user_name == $row['user_name']){
		$pass_hash = $row['password_hash'];
		if(password_verify($user_password, $pass_hash)){
			$_SESSION["user_name"] = $row['user_name'];
			$_SESSION["user_id"] = $row['id'];
			header('Location: ./personalAccount.php');
			$user_id = $row['id'];
			$basket_result = mysqli_query($db, "SELECT * FROM baskets WHERE basket_session = \"$basket_session\"");
			if($basket_result){
				$b_row = mysqli_fetch_assoc($basket_result);
				if(empty($b_row['user_id'])){
					$basket_upd_result = mysqli_query($db, "UPDATE baskets SET user_id = $user_id WHERE basket_session = \"$basket_session\" ");
				}
			}
		}else{
			echo "неверный пароль";
		}
	}else{
		echo "получатель не найден";
	}
	
	echo mysqli_error($db);
}