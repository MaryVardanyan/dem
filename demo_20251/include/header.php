<?php
    session_start();
    
    // Определяем базовый путь от корня сайта
    // $base_path = "/demo_20251/localhost/";
    
    $menu = "";
    if(isset($_SESSION['login'])){
        if($_SESSION['role'] == "admin"){
            $menu .= '<li class="nav-item">
                        <a class="nav-link" href="/demo_20251/admin/">Админ Панель</a>
                      </li>';
        }
        $menu .= '<li class="nav-item">
                    <a class="nav-link" href="/demo_20251/profile/">Личный кабинет</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="/demo_20251/controllers/logout.php">
                      Выйти </a>
                  </li>';
    }else{
        $menu = '<li class="nav-item">
                   <a class="nav-link" href="/demo_20251/index.php">Вход</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" href="/demo_20251/register/">Регистрация</a>
                 </li>';
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой Не Сам</title>
    <link rel="stylesheet" href="/demo_20251/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    
    <main>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="/demo_20251/assets/media/logo.png" alt="Logo" width="50" height="50">
                        Мой Не Сам
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?=$menu?>
                    </ul>
                    
                    </div>
                </div>
            </nav>
        </header>
