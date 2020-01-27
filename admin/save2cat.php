<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";

	$photo = $_FILES["photo"];
	$title = clearStr($_POST["title"], $link);
	$author = clearStr($_POST["author"], $link);
	$pubyear = clearInt($_POST["pubyear"], $link);
	$price = clearInt($_POST["price"], $link);


	if(!addItemToCatalog($photo, $title, $author, $pubyear, $price, $link)){
		echo "Произошла ошибка при добавлении товара в каталог";
	}else{
		echo "Книга успешно добавлена!";
	}

	?>
	<a href='index.php'>На главную</a>

