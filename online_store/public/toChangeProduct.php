<?php 
require "./connectDb.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php echo $title ?>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/861689887d.js" crossorigin="anonymous"></script>
	<style>
		body {
			margin: 0 auto;
		}
		.container {
			margin: 0 auto;
			display: flex;
			flex-direction:column;
			align-items: center;
		}
		.formView{
			width: 50%;
			margin: 15px;
			display: flex;
			flex-direction: column;
		}
		.pictures {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			flex-wrap: wrap;
			width: 70%;
		}
		.picture {
			display: flex;
			flex-direction: column;
			align-items: center;
			color: #328625;
			border: solid #999999 1px;
			border-radius: 5px;
			padding: 10px 20px;
			margin: 10px;
		}
		.smallImg {
			width: 180px;
			margin: 15px;
		}
	</style>
</head>
<body>
<div class="body_container">

<?php 

$imgPath = "./img/product_img";
$prodId = $_GET['id'];
if($prodId && is_numeric($prodId)){
	$result = mysqli_query($db, "SELECT * FROM product WHERE id = {$prodId}");
	if($result){
		$row = mysqli_fetch_assoc($result);
		if($row){
			echo "<form class=\"formView\" enctype=\"multipart/form-data\" action=\"changeProduct.php\" method=\"POST\">
				<h3>Изменение товара</h3>
				<input type=\"hidden\" name=\"id\" value=\"$prodId\">
				<label>Артикул товара</label>
				<input type=\"text\" name=\"productCode\" placeholder=\"Артикул товара\" value=\"" . $row['product_code'] . "\" disabled>
				<label>Наименование товара</label>
				<input type=\"text\" name=\"productName\" placeholder=\"Наименование товара\" value=\"" . $row['product_name'] . "\">
				<label>Описание товара</label>
				<input type=\"text\" name=\"productDecription\" value=\"" . $row['product_description'] . "\">
				<label>Цена товара</label>
				<input type=\"text\" name=\"productPrice\" value=\"" . $row['product_price'] . "\">
				<label>Количество товара</label>
				<input type=\"text\" name=\"productQuantity\" value=\"" . $row['product_quantity'] . "\">
				<label>Отображать товар на сайте</label>
				<input type=\"checkbox\" name=\"activeProduct\" "; if($row['active'] == 1){echo "checked";} echo ">
				<img class=\"smallImg\" src=\"$imgPath/" . $row['img'] . "\" alt=\"" . $row['img'] . "\">
				<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"50000\">
				<label>Изображение товара</label>
				<input type=\"file\" name=\"productImg\" value=\"" . $row['img'] . "\">
				<input type=\"submit\" value=\"Изменить товар\" >
			</form>";
		} else {
			echo "Товар не найден";
		}
	}
}


echo "<br><br><a href=\"admin.php\">Вернуться</a><br><br>";
?>



</div>
</body>