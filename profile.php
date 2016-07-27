<?php
session_start();
//session_destroy();
//session_unset();

if(isset($_POST["logout"])){
    session_destroy();
    header('Location: index.php');
}

if ($_SESSION["id"] == ''){
    header('Location: index.php');
}

$user = $_SESSION["id"];




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
                    <h3>Welcome, <?php echo $user; ?></h3>
                    <form method="post" id="logout" class="form">
                        <p class="form_text">Вы авторизованы</p>
                        <p><input type="submit" value="Выйти" class="btn"></p>
                        <input type="hidden" name="logout">
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
