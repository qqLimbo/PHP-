<?
require "secure/session.inc.php";
require "admincfg.php";
$id = $_GET["id"];
$sql = "SELECT * FROM catalog WHERE id = $id";
$result = mysqli_query($link, $sql);

$item = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Форма редактирования книг</title>
</head>
<body>
	<form action="changeBook3.php?id=<?=$item['id']?>" method="post" enctype="multipart/form-data" >
		<p>Название: <input type="text" name="title" size="100" value="<?=$item['title']?>">
		<p>Автор: <input type="text" name="author" size="50"value="<?=$item['author']?>">
		<br><img src="<?=$item['photo']?>"><br>
		<p>Сменить обложку:  <input type="file" name="photo">
		<p>Год издания: <input type="text" name="pubyear" size="4"value="<?=$item['pubyear']?>">
		<p>Цена: <input type="text" name="price" size="6" value="<?=$item['price']?>"> евро.
		<p><input type="submit" value="Изменить">
		<p><a href="/admin/changeBook.php">Отмена</a>
	</form>
</body>
</html>