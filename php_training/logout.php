<?php
header("Progma:no-cache");
header("Cache-Control:no-cache,must-revalidate");

session_destroy();


//echo "로그아웃 되었습니다.";
Header("Location:./login.html");
?>
