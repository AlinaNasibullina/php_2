<?php
require "./connectDb.php";
require "./sources/php/sessionInit.php";
require "./checkUserAccess.php";

checkUserAccess($db);
	
$id = (int)strip_tags(htmlspecialchars($_POST['id'], ENT_QUOTES));
$product_code = strip_tags(htmlspecialchars($_POST['productCode'], ENT_QUOTES));
$product_name = strip_tags(htmlspecialchars($_POST['productName'], ENT_QUOTES));
$product_desc = strip_tags(htmlspecialchars($_POST['productDecription'], ENT_QUOTES));
$product_price = (float)strip_tags(htmlspecialchars($_POST['productPrice'], ENT_QUOTES));
$product_quantity = (int)strip_tags(htmlspecialchars($_POST['productQuantity'], ENT_QUOTES));
$product_active = 0;
if ($_POST['activeProduct'] == 'on') {
	$product_active = 1;
}
$product_img = strip_tags(htmlspecialchars($_FILES['productImg']['name'], ENT_QUOTES));
$imgPath = "./img/product_img";


if($product_img == ""){
	if (is_string($product_name)
		&& is_string($product_desc)
		&& (is_float($product_price) || is_int($product_price)) 
		&& ($product_active == 1 || $product_active == 0)){ 
		$result = mysqli_query(
			$db, 
			"UPDATE	product 
			SET 
				product_name = \"$product_name\", 
				product_price = $product_price, 
				active = $product_active, 
				product_description = \"$product_desc\", 
				product_quantity = $product_quantity 
			WHERE id = $id"
			); 
			if ($result) {
				$_SESSION['message'] = "товар изменен";
				header ("Location: ./admin.php");
			} else {				
				$_SESSION['message'] = "товар изменен";
				echo "товар не изменен<br>";
				echo "Номер ошибки " . mysqli_errno($db);
				echo "Ошибка " . mysqli_error($db);
			}
		}
} else {
	$img_result = mysqli_query($db, "SELECT img FROM product WHERE id = {$id}");
	$row = mysqli_fetch_assoc($img_result);
	$del_result = unlink("$imgPath/" . $row['img']);
	if (is_string($product_name)
		&& is_string($product_desc)
		&& (is_float($product_price) || is_int($product_price)) 
		&& ($product_active == 1 || $product_active == 0) 
		&& is_string($product_img)){ 
		$result = mysqli_query(
			$db, 
			"UPDATE	product 
			SET
				product_name = \"$product_name\", 
				product_price = $product_price, 
				active = $product_active, 
				img = \"$product_img\", 
				product_description = \"$product_desc\", 
				product_quantity = $product_quantity 
			WHERE id = $id"
			); 
		if ($result) {
			if(($_FILES['productImg']['error'] == UPLOAD_ERR_OK) && 
					($_FILES['productImg']['type'] == 'image/png' 
					|| $_FILES['productImg']['type'] == 'image/gif' 
					|| $_FILES['productImg']['type'] == 'image/jpg' 
					|| $_FILES['productImg']['type'] == 'image/jpeg')) /*прописать типы через регулярное выражение (?)*/{
				$tmp_name = $_FILES['productImg']['tmp_name'];
				$result_load = move_uploaded_file($tmp_name, "$imgPath/$product_img");
				if($result_load){				
					$_SESSION['message'] = "товар изменен, изображение загружено";
					header ("Location: ./admin.php");	
				}
			} else {
				$_SESSION['message'] = "товар изменен, изображение не загружено";
				header ("Location: ./admin.php");
			}
		} else {
			$_SESSION['message'] = "товар не изменен, изображение не загружено";
			header ("Location: ./admin.php");
		}
		
	}
}


echo "<br><br><a href=\"admin.php\">Вернуться</a><br><br>";


?>