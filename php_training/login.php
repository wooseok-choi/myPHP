<?php

ini_set("display_errors",1);
ini_set("error_reporting",E_ALL);


session_start();

$link = mysqli_connect('','','','');
if(!$link){
	echo "error : ".mysqli_connect_error().PHP_EOL."<br/>";
	exit;
}
$login = [];
$login['id'] = $_POST['id'];
$login['pwd'] = $_POST['pwd'];


$query = "select * from user where(id='".$login['id']."')";

$result = mysqli_query($link, $query);


if(!$row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	echo "error! : ".mysqli_error()."<br/>";
}else{
if($row['pwd'] === $login['pwd']){
		echo "login success!\n";
		echo "session id : ".session_id()."\n"; 
		$_SESSION['name']=$row['name'];
		$_SESSION['id']=$row['id'];
		$_SESSION['pwd']=$row['pwd'];
		$_SESSION['birth']=$row['birth'];
		$_SESSION['tell_num']=$row['tell_num'];
		$_SESSION['email']=$row['email'];
		Header("Location:./main.html");	
	}else{
		echo "access denied\n";
	}

}



?>
