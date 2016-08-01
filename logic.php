<?php

header("Content-Type: text/html; charset=utf-8");
$siteUrl = $_SERVER[SERVER_NAME].$_SERVER[SCRIPT_NAME];
$postArr = $_POST;

include_once "db.php";

if($_SESSION['id'] != ""){
    header("Location: profile.php");
}

if(isset($_POST["registration"])){



    // User
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $password = md5(trim($_POST["password"]));

    // Проверка логина
    if(is_string($login) && $login != "" && preg_match("#^[aA-zZ0-9\-_]+$#",$login)){
        $login = strip_tags($login);
    } else {
        exit();
    }

    // Проверка email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        exit();
    }

    // Проверка email на уникальность
    $sqlSelect = $mysqli->query("SELECT email, login FROM users WHERE email = '$email' OR login='$login'");
    if(mysqli_num_rows($sqlSelect) == 0){
        // Запись в БД
        $sqlInsert = $mysqli->query("INSERT INTO `users` (id,`email`,`login`,`password`) VALUES (NULL,'$email','$login','$password')");
        echo "success_reg";
    } else {
        echo "unsuccessful_reg";
    }


    // Закрытие подлючения
    echo $mysqli->close;

}


if(isset($_POST["enter"])){

    // User
    $login = trim($_POST["login"]);
    $password = md5(trim($_POST["password"]));

    // Проверка email
    if(filter_var($login, FILTER_VALIDATE_EMAIL)){
        $loginType = true;
    } else {
        // Проверка логина
        if(is_string($login) && $login != "" && preg_match("#^[aA-zZ0-9\-_]+$#",$login)){
            $login = strip_tags($login);
        } else {
            exit();
        }
    }

    // Проверка пароля
    if(is_string($password) && $password != ""){
    } else {
        exit();
    }

    // Проверка email на уникальность
    if($loginType){
        $sqlSelect = $mysqli->query("SELECT email, password FROM users WHERE email = '$login' && password = '$password'");
    } else {
        $sqlSelect = $mysqli->query("SELECT login, password FROM users WHERE login = '$login' && password = '$password'");
    }
    if(mysqli_num_rows($sqlSelect) == 1){
        $_SESSION['id'] = $login; // Создание сессии
        header('Location: profile.php');
    } else {
        echo "unsuccessful_log";
    }

    // Закрытие подлючения
    echo $mysqli->close;

} 