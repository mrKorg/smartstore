<?php

include_once "../db.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php include "../style/css/bs.php"; ?>
    <link href="../style/css/style.css" rel="stylesheet">
</head>
<body>

<div class="wrapper">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-xs-12 col-md-2">
                <div class="grayBox">
                    <ul>
                        <li><a href="?page=products">Товары</a></li>
                        <li><a href="?page=add_product">Добавить товар</a></li>
                        <li><a href="?page=users">Пользователи</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 col-md-offset-1">
                <div class="grayBox">
                    <div id="content">
                        <?php
                        if($_GET["page"] == "products"){
                            include "products.php";
                        } else if($_GET["page"] == "add_product"){
                            include "add_product.php";
                        } else if($_GET["page"] == "users"){
                            include "users.php";
                        } else if($_GET["page"] == "delete_product"){
                            include "delete_product.php";
                        } else if($_GET["page"] == "edit_product"){
                            include "edit_product.php";
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="../style/js/script.js"></script>

</body>
</html>