<?
require "secure/session.inc.php";
require "admincfg.php";


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

$sql = 'DELETE FROM catalog WHERE id=?';
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $_GET['id']);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);		

header('Location: /admin/delBook.php');
exit;