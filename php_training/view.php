<!DOCTYPE=html>
<html>
<head>
	<meta charset='utf-8'/>
	<title>Photo</title>
</head>

<body>
<?php
ini_set('display_errors',1);

$file = array();

if($handle = opendir('./upload')){
	while(false !== ($entry = readdir($handle))){
		if($entry!='.' && $entry!='..'){
			$fpath = './upload/'.$entry;
			$file[filemtime($fpath)]=$entry;
		}
	}
	closedir($handle);
}

krsort($file);

foreach($file as $key=>$val){
	$rval=$val;
	$val="./upload/".$val;
	//echo $rval." ".$val;

	echo "<p><img src=".$val." alt=".$rval." width='300' height='200'><br>".$rval."</p><br>";
}
?>


</body>
</html>
