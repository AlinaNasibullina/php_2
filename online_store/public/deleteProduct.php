<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";
require "./checkUserAccess.php";

checkUserAccess($db);

$imgPath = "./img/product_img";
$prodId = $_GET['id'];
if($prodId && is_numeric($prodId)){
	$img = mysqli_query($db, "SELECT img FROM product WHERE id = {$prodId}");
	$row = mysqli_fetch_assoc($img);
	
	$result = mysqli_query($db, "DELETE FROM product WHERE id = {$prodId}");
	if($result){
		echo "Товар удален<br>";
		$del_result = unlink("$imgPath/" . $row['img']);
		
		if($del_result){
			echo "Изображение удалено<br>";
		}
	}
}



echo "<br><br><a href=\"admin.php\">Вернуться</a><br><br>";