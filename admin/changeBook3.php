<?
require "secure/session.inc.php";
require "admincfg.php";

$photo = $_FILES["photo"];
$title = $_POST["title"];
$author = $_POST["author"];
$pubyear = $_POST["pubyear"];
$price = $_POST["price"];

	if($photo["tmp_name"]){
		$array = explode(".", $photo['name']);
		$fileName = uniqid() . "." . end($array);
		$fileDir =  __DIR__ . "\\..\\img\\" . $fileName;
		move_uploaded_file($photo["tmp_name"], $fileDir);
		$fileUrl =  "/img/" . $fileName;

		$id = $_GET["id"];
		$sql = "SELECT * FROM catalog WHERE id = $id";
		$result = mysqli_query($link, $sql);
		$item = mysqli_fetch_assoc($result);
	
		if($item['photo']){
			$filePath = __DIR__ . "\\..\\img\\" . substr($item['photo'],5);
			if(file_exists($filePath)){
				unlink($filePath);
			}
		}
		$sql = 'UPDATE catalog SET photo=?, title=?, author=?, pubyear=?, price=? WHERE id=?';
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "sssiii", $fileUrl, $title, $author, $pubyear, $price, $_GET['id']);

	}else{
		$sql = 'UPDATE catalog SET  title=?, author=?, pubyear=?, price=? WHERE id=?';
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "ssiii", $title, $author, $pubyear, $price, $_GET['id']);
	}
	
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);		


	header('Location: /admin/changeBook.php');
	exit;