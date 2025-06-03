<?php
    session_start();
    session_unset();
    session_destroy();
    header('location: /demo_20251/index.php');
    exit;
?>
