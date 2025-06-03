<?php
    include ("../include/header.php");
    include ("../function/function.php");

    // Проверка авторизован ли пользователь
    if(!isset($_SESSION['login'])){
        header('location: /demo_20251/index.php');
        exit;
    }
?>

<section>
    <div class="container py-3">
        <h1 class="text-center">Подача заявки</h1>
        <div class="image w-50 mx-auto my-4">
            <img src="/demo_20251/assets/media/application.jpg" alt="application" class="w-100 rounded-pill">
        </div>
        <form action="/demo_20251/controllers/add_application.php" method="post" novalidate> 
            <div class="md-3">
                <label for="address" class="form-label f-w-b">Адрес</label>
                <input type="text" class="form-control is-valid" id="address" name="address" required >
                <div class="invalid-feedback fs-4">
                   Поле обязательно для заполнения
                </div>
            </div>
            <div class="md-3 mt-4">
                <label for="phone" class="form-label f-w-b">Телефон</label>
                <input type="tel" class="form-control is-valid" id="phone" name="phone" required pattern="\+?[0-9(\)\-\]+" placeholder="+7(XXX)-XXX-XX-XX" minlength="17" maxlength="17">
                <div class="invalid-feedback fs-4">
                   Поле обязательно для заполнения
                </div>
            </div>
            <div class="md-3 mt-4">
                <label for="date" class="form-label f-w-b">Желаемая дата</label>
                <input type="date" class="form-control is-valid" id="date" name="date" required>
                <div class="invalid-feedback fs-4">
                   Поле обязательно для заполнения
                </div>
            </div>
            <div class="md-3 mt-4">
                <label for="time" class="form-label f-w-b">Желаемое время</label>
                <input type="time" class="form-control is-valid" id="time" name="time" required>
                <div class="invalid-feedback fs-4">
                   Поле обязательно для заполнения
                </div>
            </div>
            
            <div class="md-3 mt-4">
                <label for="category" class="form-label f-w-b">Вид услуги</label>
                <select class="form-select" id="category" name="category">
                    <?=getService()?>
                </select>
            </div>
            <div class="md-3">
                <input class="form-check-input me-1" type="checkbox" value="" id="service">
                <label class="form-check-label" for="service">
                    Иная услуга
                </label>
                
                <div class="form-floating" id="description-container" style="display: none;">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" rows="6" id="description" name="description"></textarea>
                    <div class="invalid-feedback fs-4">
                        Поле обязательно для заполнения
                    </div>
                </div>
            </div>
            <div class="md-3 mt-4">
                <label for="pay" class="form-label f-w-b">Способ оплаты</label>
                <select class="form-select" id="pay" name="pay">
                    <?=getPay()?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-dark mt-4 w-100">Сформировать заявку</button>
        </form>
    </div>
</section>

<script>
    document.getElementById('service').addEventListener('change', function() {
        const descriptionContainer = document.getElementById('description-container');
        if (this.checked) {
            descriptionContainer.style.display = 'block';
        } else {
            descriptionContainer.style.display = 'none';
        }
    });
</script>

<?php
    include ("../include/footer.php");
?>
