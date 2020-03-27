<?php
ini_set("display_errors",1);
ini_set("error_reporting",E_ALL);

$link = mysqli_connect('','','','');

if(!$link){
	echo "Unable MySQL.".PHP_EOL."<br/>";
	echo "error no : ".mysqli_connect_errno().PHP_EOL."<br/>";
	echo "error : ".mysqli_connect_error().PHP_EOL."<br/>";
	exit;
}

echo "Host info : ".mysqli_get_host_info($link).PHP_EOL."<br/>";


$sign = [];
$sign['name']="'".$_POST['name']."'";
$sign['id']="'".$_POST['id']."'";
$sign['pwd']="'".$_POST['pwd']."'";
$sign['birth']="'".$_POST['birth']."'";
$sign['tell_num']="'".$_POST['tell_num']."'";
$sign['email']="'".$_POST['email']."'";


echo $sign["name"]."<br/>";
echo $sign['id']."<br/>";
echo $sign['pwd']."<br/>";
echo $sign['birth']."<br/>";
echo $sign['tell_num']."<br/>";
echo $sign['email']."<br/>";

$query = "call insert_sign(".$sign['name'].",".$sign['id'].",".$sign['pwd'].",".$sign['birth'].",".$sign['tell_num'].",".$sign['email'].")";
echo $query."<br./>";

if(!$result = mysqli_query($link,$query)){
	echo "error in insert function : ".mysqli_error($link);
}else{
	echo "success your insert<br/>";
}

$query = "create user".$sign['id']."@'localhost'identified by ".$sign['pwd'].";";
echo $query."<br>";
if(!$result = mysqli_query($link, $query)){
	echo "error in making user in mysql".mysqli_error($link)."<br>";
}else{
	echo "success making user in mysql<br>";
}

$query = "grant select, insert, update, delete on opic.* to ".$sign['id']."@localhost identified by ".$sign['pwd'].";";
if(!$result = mysqli_query($link, $query)){
	echo "error in grant".mysqli_error($link)."<br>";
}else{
	echo "success grant option<br>";
}

$query = "select * from user";

if(!$result = mysqli_query($link, $query)){
	echo "error in select function: ".mysqli_error($link);
}else{
	echo "success select : ".mysqli_num_rows($result)." rows<br/>";
	mysqli_free_result($result);
	mysqli_close($link);
	Header("Location:./login.html");
}


?>
