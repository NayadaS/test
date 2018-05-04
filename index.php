<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Таблица заказов. О! Наконец-то это сработало!!!</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
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

	$orders = $ApiClient->get("orders", array( start => 0 , limit =>  10 ));
	$arrOrders = $orders["orders"];
?>

	<table>
		<caption>Таблица заказов</caption>
		<thead>
			<tr>
				<th>Порядковый номер</th>
				<th>Номер заказа</td>
				<th>Сумма заказа (руб.)</td>
			</tr>
		</thead>
		<tbody>

<?php
	$flag = 0;
	$aaData = [];
	foreach ($arrOrders as $value) {
		$order_id = $value['order_id'];
		$summ = $value['summ'];
		$aaData[$flag]['order_id'] = $value['order_id'];
		$aaData[$flag]['summ'] = $value['summ'];
		$flag++;
?>

			<tr>
				<td><?php echo $flag; ?></td>
				<td><?php echo $order_id; ?></td>
				<td><?php echo $summ; ?></td>
			</tr>

<?php
	}
	$link = mysqli_connect('localhost', 'root', '') or die(mysqli_error($link));
	// $bases = mysqli_query($link, "SHOW DATABASES LIKE 'shop-test'") or die(mysqli_error($link));
	// if (mysqli_fetch_row($bases) === NULL) {
	// 	mysql_create_db('shop-test', $link) or die(mysqli_error($link));
	// 	mysql_select_db('shop-test') or die("Не могу подключиться к базе.");
	// 	$query = "CREATE Table tovars (
	// 	    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	// 	    order_id VARCHAR(200) NOT NULL,
	// 	    summ VARCHAR(200) NOT NULL
	// 	)";
	// 	mysqli_query($link, $query);
	// }
	mysqli_query($link, "create database if not exist 'shop-test'") or die(mysqli_error($link));
	$bases = mysqli_query($link, "SHOW DATABASES LIKE 'shop-test'") or die(mysqli_error($link));
	var_dump(mysqli_fetch_row($bases));
	
?>
		</tbody>	
	</table>
<?php
	var_dump($aaData);
?>
	<table id="example">
	  <thead>
	    <tr>
	        <th class="order">Номер заказа</th>
	        <th>Сумма заказа (руб.)</th>
	    </tr>
	  </thead>
	</table>
  <script>
  	$("#example").dataTable({	
		
  "aaData":[
    ["htmlhook.ru","https://htmlhook.ru/","Блог","2013-10-15 10:30:00"],
    ["Новый путь","http://www.phppath.ru/","Блог","2013-09-15 09:20:00"],
    ["Портал UA","http://pixelcom.at.ua/","Интернет магазин","null"],
  ],
  "aoColumnDefs":[{
        "sTitle":"Номер заказа"
      , "aTargets": [ "order" ]
  },{
        "aTargets": [ 1 ]
      , "bSortable": false
      , "mRender": function ( url, type, full )  {
          return  '<a href="'+url+'">' + url + '</a>';
      }
  },{
        "aTargets":[ 3 ]
      , "sType": "date"
      , "mRender": function(date, type, full) {
          return (full[2] == "Блог")
                    ? new Date(date).toDateString()
                    : "N/A" ;
      }
  }],
  
   language: {
      "processing": "Подождите...",
      "search": "Поиск:",
      "lengthMenu": "Показать _MENU_ записей",
      "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
      "infoEmpty": "Записи с 0 до 0 из 0 записей",
      "infoFiltered": "(отфильтровано из _MAX_ записей)",
      "infoPostFix": "",
      "loadingRecords": "Загрузка записей...",
      "zeroRecords": "Записи отсутствуют.",
      "emptyTable": "В таблице отсутствуют данные",
      "paginate": {
        "first": "Первая",
        "previous": "Предыдущая",
        "next": "Следующая",
        "last": "Последняя"
      },
      "aria": {
        "sortAscending": ": активировать для сортировки столбца по возрастанию",
        "sortDescending": ": активировать для сортировки столбца по убыванию"
      }
  }
});
  $(function(){
    $("#example").dataTable();
  })
  </script>

</body>
</html>