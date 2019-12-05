<?php
function clearStr($data, $link){
	$data = trim(strip_tags($data));
	return mysqli_real_escape_string($link, $data);
}

function clearInt($data){
	return abs((int)$data);
}

function addItemToCatalog($title, $author, $pubyear, $price, $link){
	$sql = 'INSERT INTO catalog (title, author, pubyear, price)
											VALUES(?, ?, ?, ?)';
	
	if(!$stmt = mysqli_prepare($link, $sql))
		return false;
	mysqli_stmt_bind_param($stmt, "ssii", $title, $author, $pubyear, $price);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);											
	return true;
}

function selectAllItems($link){
	$sql = 'SELECT id, title, author, pubyear, price 
					FROM catalog';
	
	if(!$result = mysqli_query($link, $sql))
		return false;
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	return $items;	
}


function saveBasket(){
	global $basket;
	$basket = base64_encode(serialize($basket));
	setcookie('basket', $basket, 0x7FFFFFFF);
}

function basketInit (){
	global $basket;
	global $count;
	if(!isset($_COOKIE['basket'])){
		$basket = ['orderid' => uniqid()];
		saveBasket($basket);
	}else{
		$basket = unserialize(base64_decode($_COOKIE['basket']));
		$count = count($basket) -1;
	}
}

function add2Basket($id){		
	global $basket;
	$basket[$id] = 1;
	saveBasket($basket);
}

function myBasket($link){
	global $basket;
	$goods = array_keys($basket);
	array_shift($goods);
	if(!$goods)
		return false;
	$ids = implode(",", $goods);
	$sql = "SELECT id, author, title, pubyear, price
					FROM catalog WHERE id IN ($ids)";
	if (!$result = mysqli_query($link, $sql))
		return false;
		
	$items = result2Array($result);
	mysqli_free_result($result);
	return $items;

}

function result2Array($data){
	global $basket;
	$arr = [];
	while ($row = mysqli_fetch_assoc($data)){
		$row['quantity'] = $basket[$row['id']];
		$arr[] = $row;
	}
	return $arr;
}

function deleteItemFromBasket($id){
	global $basket;
	unset($basket[$id]);
	saveBasket();
}