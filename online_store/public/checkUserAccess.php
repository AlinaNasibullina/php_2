<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";

function checkUserAccess($db){
	if(empty($_SESSION['user_name'])){
		header("Location: ./login.php");
		}else{
			$user_name = $_SESSION['user_name'];
			$access_result = mysqli_query($db, "SELECT role_id FROM users WHERE user_name = \"$user_name\"");
			if($access_result){
				$row = mysqli_fetch_assoc($access_result);
				if($row['role_id'] != 1){
					header("Location: ./index.php");
				}
			}
		}
}