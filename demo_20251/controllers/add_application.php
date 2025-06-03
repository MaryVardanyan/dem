<?php
    session_start();
    include("../function/connect.php");

    $sql = "SELECT * FROM `user` WHERE `login` = '{$_SESSION['login']}'";
    $result = $connect->query($sql);
    $user = $result->fetch_assoc();

    // $sql = "SELECT `id_status` FROM `status` WHERE `code` = 'new'";
    // $result = $connect->query($sql);
    // $status = $result->fetch_assoc();
    
    if($_POST["description"] != ""){
        $sql = sprintf("INSERT INTO `application`(`id_application`, `id_user`, `id_pay`, `id_service`, `id_status`, `description`, `date`, `time`, `phone`, `address`) VALUES (NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s')", 
$user['id_user'], $_POST['pay'], 1, 1, $_POST['description'], $_POST['date'], $_POST['time'], $_POST['phone'], $_POST['address']);
    }else{
        $sql = sprintf("INSERT INTO `application`(`id_application`, `id_user`, `id_pay`, `id_service`, `id_status`, `description`, `date`, `time`, `phone`, `address`) VALUES (NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s')", 
$user['id_user'], $_POST['pay'], $_POST['category'], 1, $_POST['description'], $_POST['date'], $_POST['time'], $_POST['phone'], $_POST['address']);
    }
    if($connect->query($sql)){
        header('location: /demo_20251/profile/');
        exit;
    }
?>
