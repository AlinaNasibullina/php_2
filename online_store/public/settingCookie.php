<?php
$value = "123456";
setcookie("u_user", $value, time()+3600, "/", "testsite");
$basket_session = $_COOKIE['basket_session'];