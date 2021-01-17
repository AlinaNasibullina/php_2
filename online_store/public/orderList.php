<?php
	require "./connectDb.php";
	require "./sources/php/sessionInit.php";
	require "./checkUserAccess.php";
	
	checkUserAccess($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/ShoppingCart.css">
    <script src="https://kit.fontawesome.com/861689887d.js" crossorigin="anonymous"></script>
	
	<style>
		.orderDetails {
			margin: 30px;
			width: 80%;
			display: flex;
			flex-direction: column;
		}
		.orderDetails_content{
			display: flex;
		}
		.orderDetails_row {
			display: flex;
			flex-direction: column;
			width: 60%;
			justify-content: center;
		}
		.product_details {
			width: 85%;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
		}
		.totalDetails {
			display: flex;
			flex-direction: column;
		}
		.greyLine {
		  width: 100%;
		  height: 1px;
		  background-color: #ededed;
		  margin: 0.5em 0;
		}
		.confirmBlock {
			display: flex;
			flex-direction: column;
		}
		#orderPay {
			margin: 20px 0;
		}
	</style>
</head>
<body>

<div class="body_container">
<h3>Список активных заказов</h3>
<p>По умолчанию отображаются новые заказы; заказы, ожидающие оплату; оплаченные, но не отправленные заказы.</p>

<?php
$result = mysqli_query($db, "SELECT 
								o.id, o.order_state, o.user_id, o.create_date, o.pay_date, u.user_name, u.user_full_name
							FROM orders o 
								LEFT JOIN users u ON u.id = o.user_id 
								WHERE o.order_state IN (1,2,3)
								ORDER BY o.id DESC");
	

?>
<div class="orderDetails">

<h3>Детали заказов</h3>
	<div class="greyLine"></div>
	<?php
		while($row = mysqli_fetch_assoc($result)){
			$order_id = $row['id'];
			echo "<p>Заказ № $order_id</p><div class=\"orderDetails_content\"><div class=\"orderDetails_row\">";
			$detail_result = mysqli_query($db, "SELECT l.product_id, l.product_count, l.product_price, l.subtotal_sum, l.total_sum, l.user_address, p.product_code, p.product_name, p.img 
					FROM order_list l 
					LEFT JOIN product p ON p.id = l.product_id 
					WHERE l.order_id = $order_id");
					while($detail_row = mysqli_fetch_assoc($detail_result)){
						if(!empty($detail_row['product_id'])){
							echo "
								<div class=\"product_details\">
									<p>Наименование товара: " . $detail_row['product_name'] . ", Артикул: " . $detail_row['product_code'] . ", </p>
									<p> Стоимость: $" . $detail_row['product_price'] . " x " . $detail_row['product_count'] . " = " . $detail_row['subtotal_sum'] . "</p>
								</div>
							";
						} else {
							echo "</div>
								<div class=\"totalDetails\">
									<p>Итоговая сумма: " . $detail_row['total_sum'] . "</p>
									<p>Получатель: " . $row['user_name'] . "</p>
									<p>Адрес доставки: " . $detail_row['user_address'] . "</p>
									<p>Статус заказа: "; if($row['order_state'] == 1){echo "Создан";} 
														elseif($row['order_state'] == 2){echo "Ожидает оплаты";}
														elseif($row['order_state'] == 3){echo "Оплачен, ожидает отправки";}											
									echo "</p>
									<p>Дата создания заказа: " . $row['create_date'] . "</p>
									<p>Дата оплаты заказа: " . $row['pay_date'] . "</p>
								</div>
							";
						}
					}
			echo "</div> <div class=\"greyLine\"></div>";
		}
	?>
	<br>
	<br>
	<a href="admin.php">Вернуться</a>

</div>

</div>

</body>
</html>