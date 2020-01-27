<?
require "secure/session.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Форма добавления товара в каталог</title>
</head>
<body>
	<form action="save2cat.php" method="post" enctype="multipart/form-data">
		<p>Название: <input type="text" name="title" size="100">
		<p>Автор: <input type="text" name="author" size="50">
		<p>Обложка:  <input type="file" name="photo">
		<p>Год издания: <input type="text" name="pubyear" size="4">
		<p>Цена: <input type="text" name="price" size="6"> евро.
		<p><input type="submit" value="Добавить">
		<p><a href="/admin">Отмена</a>
	</form>
</body>
</html>