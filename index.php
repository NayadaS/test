<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Таблица заказов</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
	require "vendor/shopexpress/apiclient/src/Response/ApiResponse.php";
	require "vendor/shopexpress/apiclient/src/ApiClient.php";
	use ShopExpress\ApiClient\ApiClient;
    use ShopExpress\ApiClient\Response\ApiResponse;

	$ApiClient = new ApiClient(
	    'lNwzuV_Gb',
	    'admin',
	    'http://newshop.kupikupi.org/adm/api/'
	);

	$orders = $ApiClient->get("orders", array( start => 0 , limit =>10 ));
	$arrOrders = $orders["orders"];
?>

	<table>
		<caption>Таблица заказов</caption>
		<thead>
			<tr>
				<th>Номер заказа</td>
				<th>Сумма заказа (руб.)</td>
			</tr>
		</thead>

<?php
	foreach ($arrOrders as $value) {
		$order_id = $value['order_id'];
		$summ = $value['summ'];
?>

		<tr>
			<td><?php echo $order_id; ?></td>
			<td><?php echo $summ; ?></td>
		</tr>

<?php
	}
?>
			
	</table>

</body>
</html>