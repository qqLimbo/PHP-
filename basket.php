<?php
	require "inc/lib.inc.php";
	require "inc/config.inc.php";


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php

if(!$count){
	echo "Корзина пуста! Вернитесь в <a href='catalog.php'>каталог</a>";
	exit();
}else{
	echo "Вернуться в <a href='catalog.php'>каталог</a>";
}

$goods = myBasket($link);

?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, евро.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
	
	$i = 1; $sum = 0;
	 
	foreach($goods as $item){
?>	
	<tr class="good">
		<td><?= $i++?></td>
		<td><?= $item['title']?></td>
		<td><?= $item['author']?></td>
		<td><?= $item['pubyear']?></td>
		<td class="good-price"><?= $item['price']?></td>
		<td><input class="good-quantity" type="number" id="tentacles" name="tentacles" min="1" max="100" data-good-id="<?=$item['id']?>" value="<?= $item['quantity']?>" onchange="calcSum(event)"></td>
		<td><a href="delete_from_basket.php?id=<?= $item['id']?>">удалить</a></td>
	</tr>
<?
$sum += $item['price'] * $item['quantity'];
}
?>

	
</table>


<p>
	Всего товаров в корзине на сумму:
	<span class="order-sum">
		<?=$sum?>
	</span> 
	евро.
</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>



 <script>
	function calcSum(event){
		let sum = 0;
		let goods = document.getElementsByClassName('good');
		for(let i=0; i<goods.length; i++) {
			let price = goods[i].getElementsByClassName('good-price')[0];	
			let quantity = goods[i].getElementsByClassName('good-quantity')[0];
			sum += price.innerText * quantity.value;
		}
		document.getElementsByClassName('order-sum')[0].innerText = sum;

		let valueStart = document.cookie.indexOf("basket=");
		if (valueStart == -1) return;
		valueStart = valueStart + 7;
		let valueEnd = document.cookie.indexOf("; ", valueStart);
		if (valueEnd == -1){
			var basket = document.cookie.substring(valueStart);
		}
		else{
			var basket = document.cookie.substring(valueStart, valueEnd);
		}
		
		basket = atob(basket);
		basket = JSON.parse(basket);
		let goodid = event.target.dataset.goodId;
		basket[goodid] = +event.target.value;
		basket = JSON.stringify(basket);
		basket = btoa(basket);
		document.cookie = "basket=" + basket;
		
	}

</script>
</body>
</html>







