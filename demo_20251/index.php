<?php
    include ("include/header.php");
    if(isset($_SESSION['login'])){
        header("Location: profile/");
        exit;
    }
?>

<section>
    <div class="container py-3">
        <?php
            if(isset($_GET['error'])){
                echo "<div class='border border-danger text-danger
                                  text-center p-3 my-3 mx-auto w-50'>
                {$_GET['error']}
                </div>";
            }
        ?>

        <h1 class="text-center">Вход</h1>
        <form action="controllers/login.php" method="post" class="g-3 d-flex flex-direction-column align-items-center justify-content-center" novalidate>
            <div class="col-md-4">
                <label for="login" class="form-label">Ваш логин</label>
                <input type="text" class="form-control is-valid" placeholder="ivan"
                    id="login" name="login" required>
                <div class="valid-feedback">
                Латиница и пробелы, от 2 до 40 символов
                </div>
            </div>


            <div class="col-md-4 mt-3">
                <label for="password" class="form-label">Ваш пароль</label>
                <input type="password" class="form-control is-valid"
                    id="password" name="password" required>
                <div class="valid-feedback">
                Введите пароль не менее 6 символов
                </div>
            </div>

            <input type="submit" class="btn btn-dark w-100 mt-4" value="Войти">
        </form>
    </div>
</section>


<?php
    include ("include/footer.php");
?>
