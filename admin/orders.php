<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Поступившие заказы</title>
	<meta charset="utf-8">
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php
	$orders = getOrders();
	if (!$orders){
		echo "Заказов нет";
		exit;
	}

foreach($orders as $order):

?>
<hr>
<h2>Заказ номер: <?=$order["orderid"]?></h2>
<p><b>Заказчик</b>: <?=$order["name"]?></p>
<p><b>Email</b>: <?=$order["email"]?></p>
<p><b>Телефон</b>: <?=$order["phone"]?></p>
<p><b>Адрес доставки</b>: <?=$order["address"]?></p>
<p><b>Дата размещения заказа</b>: <?=date( "Y-m-d H:i:s",$order["date"])?></p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, евро.</th>
	<th>Количество</th>
</tr>
<?php
	
	$i = 1; $sum = 0;
	 
	foreach($order["goods"] as $item){
?>	
	<tr class="good">
		<td><?= $i++?></td>
		<td><?= $item['title']?></td>
		<td><?= $item['author']?></td>
		<td><?= $item['pubyear']?></td>
		<td class="good-price"><?= $item['price']?></td>
		<td><input class="good-quantity" type="number" id="tentacles" name="tentacles" min="1" max="100" value="<?= $item['quantity']?>" onchange="calcSum(event)"></td>
	</tr>
<?
$sum += $item['price'] * $item['quantity'];
}
?>	
</table>
<p>Всего товаров в заказе на сумму: <?=$sum?> евро.</p>
<?php
endforeach; 
?>

<p><a href="/admin">назад</a>
</body>
</html>