<?php


$name = trim($_POST["email"]);

$recepient = trim($_POST["email"]);
$pagetitle = "Восстановление пароля";

$link = "http://your-webmasters.com/demo/php-lessons/password/index.php";
$message = "Для восстановления пароля перейдите <a href='".$link."'>по этой ссылке!!!</a>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

mail($recepient, $pagetitle, $message, $headers);