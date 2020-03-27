<?php
$fpath = "./upload/".$_POST['img'];
$download_file = $_POST['img'];
echo $download_file." ".$fpath;

ob_start();
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.$download_file);
header('Content-Transfer-Encoding: binary');
header('Pragma: no-cache');
header('Content-Length: '.fileSize($fpath));
header('Expires: 0');
ob_end_flush();
ob_clean();
readfile($fpath);



//ini_set('display_errors',1);


?>
