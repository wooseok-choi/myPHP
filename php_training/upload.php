<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<?php
ini_set("display_errors",1);

session_start();
echo $_SESSION['id']."<br>".$_SESSION['pwd']."<br>";

$link = mysqli_connect('',$_SESSION['id'],$_SESSION['pwd'],'');
if(!$link){
	echo "no : ".mysqli_connect_errno().PHP_EOL;
	echo "error : ".mysqli_connect_error().PHP_EOL;
	exit;
}

echo "host info ".mysqli_get_host_info($link);


$uploaddir = '';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
echo $uploadfile."<br/>";

$tmp_name = $_FILES['userfile']['tmp_name'];
echo $tmp_name."<br/>";


if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
	echo "upload success<br/>";
	$query = "insert into photo values('".$_SESSION['id']."','".$_FILES['userfile']['name']."','/var/www/html/sync/upload/',default,'".$_POST['note']."')";
	if(!$result = mysqli_query($link,$query)){
	echo "error to insert photo : ".mysqli_error($link);
	}else{
		echo "succes insert photo <br/>".PHP_EOL;
		
		$query = "select * from photo";
		if(!$result = mysqli_query($link,$query)){
			echo "error to select from photo".mysqli_error($link).PHP_EOL;
		}else{
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				echo var_dump($row)."<br>";
			}
			mysqli_free_result($result);
			mysqli_close($link);
			header("Location:./main.html");
		}
	}
	
}else{
	echo "upload failed".PHP_EOL;
	mysqli_close($link);
}



print_r($_FILES);

?>
<body>
</body>
</html>
