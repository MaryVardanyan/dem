<?php
    // Подключение шапки сайта
    include("../include/header.php");
    // Подключение функций
    include("../function/function.php");
    // Проверка авторизован ли пользователь
    if(!isset($_SESSION['login'])){
        header('location: /');
        exit;
    }
    // Проверка является ли пользователь администратором
    if($_SESSION['role'] != 'admin'){
        header('location: /profile/');
        exit;
    }
?>

<section>
    <div class="container">
        <h3 class="card-title">Панель администратора</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true">Все заявки</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-tab-pane" type="button" role="tab" aria-controls="new-tab-pane" aria-selected="false">Новые заявки</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="canceled-tab" data-bs-toggle="tab" data-bs-target="#canceled-tab-pane" type="button" role="tab" aria-controls="canceled-tab-pane" aria-selected="false">Отмененные заявки</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="confirmed-tab" data-bs-toggle="tab" data-bs-target="#confirmed-tab-pane" type="button" role="tab" aria-controls="confirmed-tab-pane" aria-selected="false">Подтвержденные заявки</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="process-tab" data-bs-toggle="tab" data-bs-target="#process-tab-pane" type="button" role="tab" aria-controls="process-tab-pane" aria-selected="false">Заявки в процессе</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0"><?=allAdmin()?></div>
            <div class="tab-pane fade" id="new-tab-pane" role="tabpanel" aria-labelledby="new-tab" tabindex="0"><?=razdelAdmin('new')?></div>
            <div class="tab-pane fade" id="canceled-tab-pane" role="tabpanel" aria-labelledby="canceled-tab" tabindex="0"><?=razdelAdmin('canceled')?></div>
            <div class="tab-pane fade" id="confirmed-tab-pane" role="tabpanel" aria-labelledby="confirmed-tab" tabindex="0"><?=razdelAdmin('confirmed')?></div>
            <div class="tab-pane fade" id="process-tab-pane" role="tabpanel" aria-labelledby="process-tab" tabindex="0"><?=razdelAdmin('process')?></div>
        </div>
    </div>
</section>

<?php
    include ("../include/footer.php");
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.admin-nav button');
    const panels = document.querySelectorAll('.admin-content > div');
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            // Hide all panels
            panels.forEach(panel => panel.style.display = 'none');
            
            // Show target panel
            const targetId = this.getAttribute('data-target').substring(1);
            document.getElementById(targetId).style.display = 'block';
        });
    });
});
</script>