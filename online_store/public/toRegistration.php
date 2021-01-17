<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";

$user_name = strip_tags(htmlspecialchars($_POST['userName'], ENT_QUOTES));
$user_full_name = strip_tags(htmlspecialchars($_POST['userFullName'], ENT_QUOTES));
$user_password = strip_tags(htmlspecialchars($_POST['userPassword'], ENT_QUOTES));
$user_password_repeat = strip_tags(htmlspecialchars($_POST['userPasswordRepeat'], ENT_QUOTES));
if($user_password === $user_password_repeat){
	$user_pass_hash = password_hash(strip_tags(htmlspecialchars($_POST['userPassword'])), PASSWORD_DEFAULT);
}else{
	$_SESSION["message"] = "пароли не совпадают";
	header ("Location: ./Registration.php");
}
$check_result = mysqli_query($db, "SELECT * FROM users WHERE user_name = \"$user_name\"");
if($check_result){
	$row_cnt = mysqli_num_rows($check_result);
	if($row_cnt != 0){
		$_SESSION["message"] = "получтаель с таким логином уже зарегистрирован";
		header ("Location: ./Registration.php");
	}else{
		
		var_dump ($user_name);
		var_dump ($user_full_name);
		var_dump ($user_pass_hash);
		if(is_string($user_name) && $user_name != "" 
			&& is_string($user_full_name) && $user_full_name != ""
			&& is_string($user_pass_hash) && $user_pass_hash != ""){
				$result = mysqli_query($db, "INSERT INTO 
					users (role_id, user_name, user_full_name, password_hash)
					VALUE (2, \"$user_name\", \"$user_full_name\", \"$user_pass_hash\")");
				if($result){
					$_SESSION["message"] = "Вы успешно зарегистрированы";
					header ("Location: ./personalAccount.php");
				}else{
					echo mysqli_error($db);
				}
							
				
			} else {
				$_SESSION["message"] = "не все поля заполнены корректно";
				header ("Location: ./Registration.php");
			}
	}
}