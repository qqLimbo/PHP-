<?php
	
	require "inc/lib.inc.php";
	require "inc/config.inc.php";

	$goods = selectAllItems($link);
	if($goods === false){ echo "Error";exit;}
	if(!count($goods)){ echo "Empty";exit;}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Каталог книг</title>
</head>
<body>
<p>Книг в <a href="basket.php">корзине</a>: <?= $count?></p>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>Обложка</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, евро.</th>
	<th>В корзину</th>
</tr>
<?php

foreach($goods as $item){
?>
	<tr>
		<td><img style="height:100px; width:100px; object-fit:contain;" src="<?= $item['photo'] ? $item['photo'] : "/img/default.png" ?>"></td>
		<td><?= $item['title']?></td>
		<td><?= $item['author']?></td>
		<td><?= $item['pubyear']?></td>
		<td><?= $item['price']?></td>
		<td><a href="add2basket.php?id=<?= $item['id']?>">В корзину</a></td>
	</tr>
<?
}

?>
</table>
</body>
</html>