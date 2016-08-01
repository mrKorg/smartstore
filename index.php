<?php

session_start();
//session_destroy();

?>

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
                    <form method="post" id="form-reg" class="form">
                        <h3>Регистрация</h3>
                        <p class="form_text message" style="display: none;"></p>
                        <p><input type="text" placeholder="Логин" name="login" required></p>
                        <p><input type="text" placeholder="Введите e-mail" name="email" required></p>
                        <p><input type="password" placeholder="Введите пароль" name="password" required></p>
                        <p><input type="submit" value="Зарегистрироваться" class="btn"></p>
                        <input type="hidden" name="registration">
                        <br>
                        <p><a href="#" id="loginLink">Уже зарегистирован?</a></p>
                    </form>
                    <form method="post" id="form-login" class="form" style="display: none;">
                        <h3>Авторизоваться</h3>
<!--                        --><?php // if($wrong): ?>
<!--                            <p class="form_text">Неверный логин или пароль</p>-->
<!--                        --><?php //endif; ?>
                        <p class="form_text message" style="display: none;"></p>
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
<script src="style/js/script.js"></script>

</body>
</html>