<?php
    include("../function/connect.php");

    $sql = "SELECT `id_status` FROM `status` WHERE `code` = '{$_GET['type']}'";
    $result = $connect->query($sql);
    $status = $result->fetch_assoc();
    if($_GET['type'] == "canceled"){
        $sql = sprintf("UPDATE `application` SET `id_status`='%s', `status_info`='%s' WHERE `id_application`='%s'", $status['id_status'], $_GET['info'], $_GET['id']);
    }else{
        $sql = sprintf("UPDATE `application` SET `id_status`='%s' WHERE `id_application`='%s'", $status['id_status'], $_GET['id']);
    }
    
    if($connect->query($sql)){
        header('location: /demo_20251/admin/');
        exit;
    }
?>
