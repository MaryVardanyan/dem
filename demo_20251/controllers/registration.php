<?php
    session_start();
    include("../function/connect.php");

    $sql = "SELECT * FROM `user` WHERE `login` = '{$_POST['login']}'";

    $result = $connect->query($sql);

    if($result->num_rows){
        header('location: /demo_20251/register/?error=Пользователь с таким login уже зарегистрирован');
        exit;
    }else{
        // $sql_role = "SELECT `id_role` FROM `role` WHERE `name` = 'user'";
        // $role = $connect->query($sql_role)->fetch_assoc()['id_role'];

        $sql = sprintf("INSERT INTO `user`(`id_user`, `name`, `surname`, `patronymic`,`login`, `phone`, `email`, `password`, `id_role`) VALUES (NULL,'%s','%s','%s','%s','%s','%s','%s','%s')", 
        $_POST['name'], 
        $_POST['surname'], 
        $_POST['patronymic'], 
        $_POST['login'], 
        $_POST['phone'], 
        $_POST['email'], 
        $_POST['password'],
        1);
        if($connect->query($sql)){
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['role'] = 'user';
            header('location: /demo_20251/profile/');
            exit;
        }
    }
?>
