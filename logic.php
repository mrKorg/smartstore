<?php

session_start();

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
        echo "not_valid_login";
        exit();
    }

    // Проверка email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "not_valid_email";
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
        echo "$loginType";
    } else {
        // Проверка логина
        if(is_string($login) && $login != "" && preg_match("#^[aA-zZ0-9\-_]+$#",$login)){
            $login = strip_tags($login);
        } else {
            echo "not_valid_login";
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
        echo "success_log";
    } else {
        echo "unsuccessful_log";
    }

    // Закрытие подлючения
    echo $mysqli->close;

}


if(isset($_POST["add_product"])){

    // Product
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $content = trim($_POST["content"]);
    $price = trim($_POST["price"]);
    $count = trim($_POST["count"]);
    $category_id = trim($_POST["category_id"]);

    $sqlInsert = $mysqli->query("INSERT INTO `products` (id,`product`,`description`,`content`,`price`,`count`,`category_id`) 
    VALUES (NULL,'$name','$description','$content','$price','$count','$category_id')");

    echo "success_add";

    // Закрытие подлючения
    echo $mysqli->close;
}

if(isset($_POST["edit_product"])){

    // Product
    $id = trim($_POST["id"]);
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $content = trim($_POST["content"]);
    $price = trim($_POST["price"]);
    $count = trim($_POST["count"]);
    $category_id = trim($_POST["category_id"]);

    $sqlInsert = $mysqli->query("UPDATE `products` 
    SET product='$name', description='$description', content='$content', price='$price', count='$count', category_id='$category_id' 
    WHERE id=$id ");

    echo "success_edit";

    // Закрытие подлючения
    echo $mysqli->close;
}

if(isset($_POST["delete_product"])){

    // Product
    $products = $_POST["del_prod"];
    $resultSQL;
    $count = 0;
    foreach ($products as $product) {
        global $resultSQL;
        global $count;
        if($count == 0){
            $or = "";
        } else {
            $or = " OR ";
        }
        $resultSQL = $resultSQL . $or . "`id` = " . $product;
        $count++;
    }
    $sqlInsert = $mysqli->query("DELETE FROM `products` WHERE $resultSQL");
    echo "success_delete";

    // Закрытие подлючения
    echo $mysqli->close;
}