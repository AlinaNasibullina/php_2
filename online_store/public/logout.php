<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";

unset($_SESSION['user_name']);
unset($_SESSION['user_id']);

if(empty($_SESSION['user_name']) && empty($_SESSION['user_id'])){
	header("Location: ./login.php");
}