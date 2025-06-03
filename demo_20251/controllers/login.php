<?php
    session_start();
    include("../function/connect.php");

    $sql = "SELECT `login`, `role`.`name` AS `role` FROM `user` INNER JOIN `role` ON `role`.`id_role` = `user`.`id_role` WHERE `login` = '{$_POST['login']}' AND `password` = '{$_POST['password']}'";

    $result = $connect->query($sql);

    if(!$result->num_rows){
        header('location: /demo_20251/index.php?error=Не верный логин или пароль');
        exit;
    }else{
        $user = $result->fetch_assoc();

        $_SESSION['login'] = $user['login'];
        $_SESSION['role'] = $user['role'];
        
        if($_SESSION['role'] != 'admin'){
            header('location: /demo_20251/profile/');
            exit; 
        }else{
            header('location: /demo_20251/admin/');
            exit; 
        }
    }
?>
