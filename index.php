<?php

session_start();
//session_destroy();

$siteUrl = $_SERVER[SERVER_NAME].$_SERVER[SCRIPT_NAME];
$postArr = $_POST;

if($_SESSION['id'] != ""){
    header("Location: profile.php");
}

if(isset($_POST["registration"])){

    // User
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $password = md5(trim($_POST["password"]));
    $emailUnique = null;

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

    // Подключение к БД
    $connect = mysqli_connect('localhost', 'root', '', 'users');

    // Проверка подключения на ошибку
    if(mysqli_connect_errno()){
        exit();
    }

    // SQL запрос
    mysqli_set_charset($connect, 'utf8'); // Указание кодировки

    // Проверка email на уникальность
    $sqlSelect = "SELECT email, login FROM users WHERE email = '$email' OR login='$login'";
    $resultSelect = mysqli_query($connect, $sqlSelect);
    if(mysqli_num_rows($resultSelect) == 0){
        // Запись в БД
        $sqlInsert = "INSERT INTO `users` (id,`email`,`login`,`password`) VALUES (NULL,'$email','$login','$password')";
        $resultInsert = mysqli_query($connect, $sqlInsert);
        $emailUnique = true;
    } else {
        $emailUnique = false;
    }

    // Закрытие подлючения
    mysqli_close($connect);

}

// Отображение нужной формы
$show = "reg";
if(isset($_POST["registration"]) && $emailUnique){
    $show = "login";
} else {
    $show = "reg";
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

    // Подключение к БД
    $connect = mysqli_connect('localhost', 'root', '', 'users');

    // Проверка подключения на ошибку
    if(mysqli_connect_errno()){
        exit();
    }

    // SQL запрос
    mysqli_set_charset($connect, 'utf8'); // Указание кодировки

    // Проверка email на уникальность
    if($loginType){
        $sqlSelect = "SELECT email, password FROM users WHERE email = '$login' && password = '$password'";
    } else {
        $sqlSelect = "SELECT login, password FROM users WHERE login = '$login' && password = '$password'";
    }
    $resultSelect = mysqli_query($connect, $sqlSelect);
    if(mysqli_num_rows($resultSelect) == 1){
        $_SESSION['id'] = $login; // Создание сессии
        header('Location: profile.php');
    } else {
        $wrong = true;
        $show = "login";
    }

    // Закрытие подлючения
    mysqli_close($connect);

} ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php include "style/css/bs.php"; ?>
    <link href="style/css/style.css" rel="stylesheet">
</head>
<body>

<div class="wrapper">
    <div class="container content" id="content">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="grayBox">
                    <form action="index.php" method="post" id="form-reg" class="form" <?php if( $show != "reg" ): ?>style="display: none;"<?php endif; ?>>
                        <h3>Регистрация</h3>
                        <p class="form_text"><?php if(!$emailUnique && !is_null($emailUnique)){echo "Логин или Email уже существует!";} ?></p>
                        <p><input type="text" placeholder="Логин" name="login"></p>
                        <p><input type="text" placeholder="Введите e-mail" name="email"></p>
                        <p><input type="password" placeholder="Введите пароль" name="password"></p>
                        <p><input type="submit" value="Зарегистрироваться" class="btn"></p>
                        <input type="hidden" name="registration">
                        <br>
                        <p><a href="#" id="loginLink">Уже зарегистирован?</a></p>
                    </form>
                    <form action="index.php" method="post" id="form-login" class="form" <?php if( $show != "login" ): ?>style="display: none;"<?php endif; ?>>
                        <h3>Авторизоваться</h3>
                        <?php  if($wrong): ?>
                            <p class="form_text">Неверный логин или пароль</p>
                        <?php endif; ?>
                        <p><input type="text" placeholder="Логин или Email" name="login" required></p>
                        <p><input type="password" placeholder="Введите пароль" name="password" required></p>
                        <p><input type="submit" value="Войти" class="btn"></p>
                        <input type="hidden" name="enter">
                        <br>
                        <p><a href="#" id="regLink">Зарегистрироваться</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="node_modules/push.js/push.min.js"></script>
<script src="style/js/script.js"></script>

</body>
</html>