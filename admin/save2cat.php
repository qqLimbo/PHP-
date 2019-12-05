<?php
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";

	$title = clearStr($_POST["title"], $link);
	$author = clearStr($_POST["author"], $link);
	$pubyear = clearInt($_POST["pubyear"], $link);
	$price = clearInt($_POST["price"], $link);


	if(!addItemToCatalog($title, $author, $pubyear, $price, $link)){
		echo "Произошла ошибка при добавлении товара в каталог";
	}else{
		header("Location: add2cat.php");
		exit();
	}

