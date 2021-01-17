<?php
require "./connectDb.php";


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
$uploads_dir = './img/product_img';



if ((is_string($product_name) && $product_name != '')
	&& (is_string($product_desc) && $product_desc != '')
	&& ((is_float($product_price) || is_int($product_price)) && $product_price > 0) 
	&& ($product_active == 1 || $product_active == 0) 
	&& is_string($product_img)){
		$result = mysqli_query(
			$db, 
			"INSERT INTO 
				product (product_code, product_name, product_price, active, img, product_description, product_quantity) 
				VALUE (\"$product_code\", \"$product_name\", $product_price, $product_active, \"$product_img\", \"$product_desc\", $product_quantity)"
			);
		if ($result) {
			if(($_FILES['productImg']['error'] == UPLOAD_ERR_OK) && 
					($_FILES['productImg']['type'] == 'image/png' 
					|| $_FILES['productImg']['type'] == 'image/gif' 
					|| $_FILES['productImg']['type'] == 'image/jpg' 
					|| $_FILES['productImg']['type'] == 'image/jpeg')) {
				$tmp_name = $_FILES['productImg']['tmp_name'];
				$result_load = move_uploaded_file($tmp_name, "$uploads_dir/$product_img");
				if($result_load){
					$_SESSION["message"] = "изображение загружено";
					header ("Location: ./admin.php");	
				}
			} else {
				$_SESSION["message"] = "изображение не загружено";
				header ("Location: ./admin.php");
			}
	} elseif (mysqli_errno($db) == 1062) {
		$_SESSION["message"] = "Данный товар уже есть в базе";
		header ("Location: ./admin.php");
	} else {
		echo "<br>Номер ошибки " . mysqli_errno($db);
		echo "<br>Ошибка " . mysqli_error($db);
	}
	
} else {
	echo "Не все поля заполнены корректно<br><br>";
}

echo "<br><br><a href=\"admin.php\">Вернуться</a><br><br>";

?>