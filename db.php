<?php

$config = parse_ini_file("config/config.ini"); // Возвращает массив
if(!empty($config)){
    $mysqli = new mysqli($config['host'],$config['user'],$config['password'],$config['bd']); // Создаём объект подключения
    if($mysqli->connect_errno){ // Проверка подключения
        echo $mysqli->connect_error;
        exit();
    }
}