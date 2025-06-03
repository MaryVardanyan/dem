<?php
    $connect = new mysqli("localhost", "root", "root", "db_demo_2025");

    if($connect->connect_error){
        die ("Ошибка подключения к базе данных");
    }
?>
