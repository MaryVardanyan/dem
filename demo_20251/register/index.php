<?php
    include ("../include/header.php");
    if(isset($_SESSION['login'])){
        header("Location: /demo_20251/profile/");
        exit;
    }

?>


<section>
    <div class="container py-3">
        <h1 class="text-center">Регистрация</h1>
        <?php
            if(isset($_GET['error'])){
                echo "<div class='w-50 mx-auto text-danger 
                                  border border-danger p-3 my-3'> 
                    {$_GET['error']}
                </div>";
            }
        ?>
        <form class="d-flex flex-direction-column w-100 g-3 align-items-center justify-content-center" action="/demo_20251/controllers/registration.php" method="post" novalidate>
            <div class="col-md-4">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control is-valid" id="name" placeholder="Иван" name="name" pattern="[а-яА-ЯЁё\s]{2,40}" required>
                <div class="valid-feedback">
                Кириллица и пробелы, от 2 до 40 символов
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label for="surname" class="form-label">Фамилия</label>
                <input type="text" class="form-control is-valid" id="surname" placeholder="Иванов" name="surname" required pattern="[А-Яа-яЁё\s]{2,40}">
                <div class="valid-feedback">
                Кириллица и пробелы, от 2 до 40 символов
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label for="patronymic" class="form-label">Отчество</label>
                <input type="text" class="form-control is-valid" id="patronymic" placeholder="Иванович" name="patronymic" required pattern="[А-Яа-яЁё\s]{2,40}">
                <div class="valid-feedback">
                Кириллица и пробелы, от 2 до 40 символов
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label for="login" class="form-label">Логин</label>
                <input type="text" class="form-control is-valid" id="login" placeholder="ivan" name="login" required pattern="[A-Za-z0-9]{2,40}">
                <div class="valid-feedback">
                Латиница и пробелы, от 2 до 40 символов
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="tel" class="form-control is-valid" id="phone" name="phone" required pattern="\+?[0-9(\)\-\]+" placeholder="+7(XXX)-XXX-XX-XX" minlength="17" maxlength="17">
                <div class="valid-feedback">
                Введите номер телефона в формате +7(XXX)-XXX-XX-XX
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control is-valid" id="email" name="email" required>
                <div class="valid-feedback">
                Введите email в формате name@mail.ru
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control is-valid" id="password" name="password" required minlength="6">
                <div class="valid-feedback">
                Введите пароль не менее 6 символов
                </div>
            </div>
            <div class="col-12 mt-4">
                <button class="btn btn-primary btn-dark w-100" type="submit">Зарегистрироваться</button>
            </div>
        </form>
        <!-- <form action="/demo_20251/localhost/admin/controllers/registration.php" method="post" class=" w-50 mx-auto needs-validation" novalidate>

            <div class="mb-3">
                <label for="name" class="form-label fs-3">Имя</label>
                <input type="text" class="form-control fs-3 rounded-pill shadow-sm px-3" id="name" name="name" pattern="[а-яА-ЯЁё\s]{2,40}" required>
                <div id="nameHelp" class="form-text fs-6">Кириллица и пробелы, от 2 до 40 символов</div>
                <div class="invalid-feedback fs-4">
                    Проверьте введенные данные
                </div>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label fs-3">Фамилия</label>
                <input type="text" class="form-control fs-3 rounded-pill shadow-sm px-3" id="surname" name="surname" required pattern="[А-Яа-яЁё\s]{2,40}">
                <div id="surnameHelp" class="form-text fs-6">Кириллица и пробелы, от 2 до 40 символов</div>
                <div class="invalid-feedback fs-4">
                    Проверьте введенные данные
                </div>
            </div>
            <div class="mb-3">
                <label for="patronymic" class="form-label fs-3">Отчество</label>
                <input type="text" class="form-control fs-3 rounded-pill shadow-sm px-3" id="patronymic" name="patronymic" required pattern="[А-Яа-яЁё\s]{2,40}">
                <div id="patronymicHelp" class="form-text fs-6">Кириллица и пробелы, от 2 до 40 символов</div>
                <div class="invalid-feedback fs-4">
                    Проверьте введенные данные
                </div>
            </div>
            <div class="mb-3">
                <label for="login" class="form-label fs-3">Логин</label>
                <input type="text" class="form-control fs-3 rounded-pill shadow-sm px-3" id="login" name="login" required pattern="[A-Za-z0-9]{2,40}">
                <div id="loginHelp" class="form-text fs-6">Латиница и пробелы, от 2 до 40 символов</div>
                <div class="invalid-feedback fs-4">
                    Проверьте введенные данные
                </div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fs-3">Телефон</label>
                <input type="tel" class="form-control fs-3 rounded-pill shadow-sm px-3" id="phone" name="phone" required pattern="\+?[0-9(\)\-\]+" placeholder="+7(XXX)-XXX-XX-XX" minlength="17" maxlength="17">
                <div id="phoneHelp" class="form-text fs-6">Введите номер телефона в формате +7(XXX)-XXX-XX-XX</div>
                <div class="invalid-feedback fs-4">
                    Проверьте введенные данные
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fs-3">Email</label>
                <input type="email" class="form-control fs-3 rounded-pill shadow-sm px-3" id="email" name="email" required>
                <div id="emailHelp" class="form-text fs-6">Введите email в формате name@mail.ru</div>
                <div class="invalid-feedback fs-4">
                    Проверьте введенные данные
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fs-3">Пароль</label>
                <input type="password" class="form-control fs-3 rounded-pill shadow-sm px-3" id="password" name="password" required minlength="6">
                <div id="passwordHelp" class="form-text fs-6">Введите пароль не менее 6 символов</div>
                <div class="invalid-feedback fs-4">
                    Проверьте введенные данные
                </div>
            </div>
            <button type="submit" class="btn btn-success p-3 rounded-pill shadow-sm fw-bold w-100 fs-3 my-3">Зарегистрироваться</button>
        </form> -->
    </div>
</section>



<?php
    include ("../include/footer.php");
?>
