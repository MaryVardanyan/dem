<?php
    include ("../include/header.php");
    include ("../function/function.php");

    if(!isset($_SESSION['login'])){
        header("Location: /demo_20251/index.php");
        exit;
    }
?>

<section>
    <div>
        <h1 class="mt-4 text-center">Личный кабинет</h1>
        
        <?php 
            echo getProfile($_SESSION['login']);
        ?> 

        <a href="/demo_20251/application/" class="btn btn-dark w-100 mt-4 mb-4">
            Сформировать заявку
        </a>
    </div>
</section>

<?php
    include ("../include/footer.php");
?>

