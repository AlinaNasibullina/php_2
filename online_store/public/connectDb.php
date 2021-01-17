<?php
	$db = mysqli_connect('localhost', 'root', 'root', 'shop_brand');
		if(!$db){
			echo "Ошибка подключения к базе данных";
			echo "Номер ошибки " . mysqli_connect_errno();
			echo "Ошибка " . mysqli_connect_error();	
		}
		
		
	//mysqli_close($db);	
?>