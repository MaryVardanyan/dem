<?php
    // error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    // ini_set('display_errors', 0);
    
    include "connect.php";

    function getService(){
        global $connect;
        $sql = "SELECT * FROM `service` WHERE `id_service` > 1";
        $result = $connect->query($sql);
        $data = "";
        foreach($result as $item){
            $data .= sprintf('<option value="%s">%s</option>', $item['id_service'],
                                                               $item["name"]);
        }
        return $data;
    }
    
    function getPay(){
        global $connect;
        $sql = "SELECT * FROM `pay`";
        $result = $connect->query($sql);
        $data = "";
        foreach($result as $item){
            $data .= sprintf('<option value="%s">%s</option>', $item['id_pay'], $item["name"]);
        }
        return $data;
    }
    

    // Простая реализация вывода

    function getProfile($login){
        global $connect;
        $sql = "SELECT * FROM `user` WHERE `login` = '{$login}'";
        $result = $connect->query($sql);
        $user = $result->fetch_assoc();
        $sql = "SELECT `id_application`,`status_info`, `date`, `time`,
               `pay`.`name` AS `pname`, `status`, `service`.`name` AS `sname`,
                `description`, `service`.`id_service` FROM `application` INNER JOIN
                `service` ON `application`.`id_service` = `service`.`id_service`
                INNER JOIN `pay` ON `application`.`id_pay` = `pay`.`id_pay`
                INNER JOIN `status` ON `application`.`id_status` =   
                `status`.`id_status` WHERE `application`.`id_user` = 
                {$user['id_user']} ORDER BY `id_application` DESC";
        $result = $connect->query($sql);
        if(!$result->num_rows){
            $data = "<h2 class='text-center'>Заявок не найдено<h2>";
        }else{
            $data = "<div class='row row-cols-1 row-cols-md-2 g-4'>";
    
            foreach($result as $item){
                $data .= sprintf('
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-3">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                        </div>
                    </div>', 
                    $item['id_application'], 
                    $item['status'], 
                    $item['sname'], 
                    $item['date'], 
                    $item['time'], 
                    $item['pname'], 
                    ($item['id_service'] == "1") ? $item['description'] : $item['sname']
                );
            }
            
    
            $data .= "</div>";
        }
    
        return $data;
    }
    



    function allAdmin(){
        global $connect;

        $sql = "SELECT `id_application`, `user`.`name` AS `u_name`, `surname`, `patronymic`, `status`,`status_info`, `date`, `time`,`address`, `pay`.`name` AS `pname`, `service`.`name` AS `sname`, `code`, `description`, `service`.`id_service`, `application`.`phone`AS `a_phone` FROM `application` 
                INNER JOIN `service` ON `application`.`id_service` = `service`.`id_service` 
                INNER JOIN `pay` ON `application`.`id_pay` = `pay`.`id_pay` 
                INNER JOIN `status` ON `application`.`id_status` = `status`.`id_status` 
                INNER JOIN `user` ON `application`.`id_user` = `user`.`id_user` 
                ORDER BY `id_application` DESC";
        
        $result = $connect->query($sql);
        if(!$result->num_rows){
            $data = "<h4 class='display-6 text-center'>Заявок не найдено<h4>";
        }else{
            $data = "<div class='row row-cols-1 row-cols-md-2 g-4'>";
            
            foreach($result as $item){
                if($item['code'] == "new"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 or-blue">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                            <div class="w-100">
                                <a href="/demo_20251/controllers/update_applicate.php?id=%s&type=process" 
                                class="btn btn-outline-warning w-100"     
                                title="Изменение статуса заявки на \'В работе\'">В работе</a>
                                <a href="/demo_20251/controllers/update_applicate.php?id=%s&type=confirmed" 
                                class="btn btn-outline-success w-100"
                                title="Изменение статуса заявки на \'Выполнено\'">Выполнено</a>
                            
                                <form action="/demo_20251/controllers/update_applicate.php" method="GET">
                                    <input type="hidden" name="id" value="%s">
                                    <input type="hidden" name="type" value="canceled">
                                    <textarea class="form-control w-100" rows="6" name="info" 
                                            required placeholder="Причина отмены"></textarea>
                                    <button class="btn btn-outline-danger w-100"  title="Изменение статуса заявки на \'Отменено\'">Отменить</button>
                                </form>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'],
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                   
                     $item['status'], 
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "1") ? $item['description'] : $item['sname'],
                     $item['id_application'], 
                     $item['id_application'], 
                     $item['id_application']); 
                 }elseif($item['code'] == "canceled"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 red-admin">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Причина отмены</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'], 
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                  
                     $item['status'], 
                     $item['status_info'],
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "1") ? $item['description'] : $item['sname']);
                 }elseif($item['code'] == "confirmed"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 or-green">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'],
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                  
                     $item['status'], 
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "1") ? $item['description'] : $item['sname']);
                 }elseif($item['code'] == "process"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 or-admin">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                            <div class="w-100">
                               
                                <a href="/demo_20251/controllers/update_applicate.php?id=%s&type=confirmed" 
                                class="btn btn-outline-success w-100"
                                title="Изменение статуса заявки на \'Выполнено\'">Выполнено</a>
                            
                                <form action="/demo_20251/controllers/update_applicate.php" method="GET">
                                    <input type="hidden" name="id" value="%s">
                                    <input type="hidden" name="type" value="canceled">
                                    <textarea class="form-control" rows="6" name="info" 
                                            required placeholder="Причина отмены"></textarea>
                                    <button class="btn btn-outline-danger w-100"  title="Изменение статуса заявки на \'Отменено\'">Отменить</button>
                                </form>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'],
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                   
                     $item['status'], 
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "1") ? $item['description'] : $item['sname'],
                     $item['id_application'],
                     $item['id_application']);
                 }
             }     
    
            $data .= "</div>";
        }
    
        return $data;
    }


    function razdelAdmin($code){
        global $connect;
        $sql = "SELECT `id_status` FROM `status` WHERE `code` = '{$code}'";
        $result = $connect->query($sql);
        $status = $result->fetch_assoc();
        
        // Добавляем условие для новых заявок - только за последние 24 часа
        // $date_condition = "";
        // if($code == "new") {
        //     $date_condition = " AND `date` >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        // }
        
        $sql = "SELECT `id_application`, `user`.`name` AS `u_name`, `surname`, `patronymic`, `status`,`status_info`, `date`, `time`,`address`, `pay`.`name` AS `pname`, `service`.`name` AS `sname`, `code`, `description`, `service`.`id_service`, `application`.`phone`AS `a_phone` FROM `application` 
                INNER JOIN `service` ON `application`.`id_service` = `service`.`id_service` 
                INNER JOIN `pay` ON `application`.`id_pay` = `pay`.`id_pay` 
                INNER JOIN `status` ON `application`.`id_status` = `status`.`id_status` 
                INNER JOIN `user` ON `application`.`id_user` = `user`.`id_user` 
                WHERE `application`.`id_status` = '{$status['id_status']}' 
                ORDER BY `id_application` DESC";
        $result = $connect->query($sql);
        if(!$result->num_rows){
            if($code == "new"){
                $data = "<h4 class='display-6 text-center'>Новых заявок не найдено<h4>";
            }elseif($code == "process"){
                $data = "<h4 class='display-6 text-center'>Заявок в процессе не найдено<h4>";
            }elseif($code == "canceled"){
                $data = "<h4 class='display-6 text-center'>Отменных заявок не найдено<h4>";
            }elseif($code == "confirmed"){
                $data = "<h4 class='display-6 text-center'>Выполненных заявок не найдено<h4>";
            }
        }else{
            $data = "<div class='cards row row-cols-1 row-cols-md-3 g-4'>";
            foreach($result as $item){
                if($item['code'] == "new"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 or-blue">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                            <div class="w-100">
                                <a href="/demo_20251/controllers/update_applicate.php?id=%s&type=process" 
                                class="btn btn-outline-warning w-100"     
                                title="Изменение статуса заявки на \'В работе\'">В работе</a>
                                <a href="/demo_20251/controllers/update_applicate.php?id=%s&type=confirmed" 
                                class="btn btn-outline-success w-100"
                                title="Изменение статуса заявки на \'Выполнено\'">Выполнено</a>
                            
                                <form action="/demo_20251/controllers/update_applicate.php" method="GET">
                                    <input type="hidden" name="id" value="%s">
                                    <input type="hidden" name="type" value="canceled">
                                    <textarea class="form-control w-100" rows="6" name="info" 
                                            required placeholder="Причина отмены"></textarea>
                                    <button class="btn btn-outline-danger w-100"  title="Изменение статуса заявки на \'Отменено\'">Отменить</button>
                                </form>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'],
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                   
                     $item['status'], 
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "0") ? $item['description'] : $item['sname'],$item['id_application'], 
                     $item['id_application'], 
                     $item['id_application']); 
                 }elseif($item['code'] == "canceled"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 red-admin">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Причина отмены</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'], 
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                  
                     $item['status'], 
                     $item['status_info'],
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "1") ? $item['description'] : $item['sname']);
                 }elseif($item['code'] == "confirmed"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 or-green">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'],
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                  
                     $item['status'], 
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "1") ? $item['description'] : $item['sname']);
                 }elseif($item['code'] == "process"){
                     $data .= sprintf('
                     <div class="col">
                         <div class="card mb-3 or-admin">
                            <div class="card-body">
                                <h5 class="card-title fs-3">Заявка №%s</h5>
                                <p class="card-text mb-2">
                                    <span>Фамилия</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Имя</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Отчество</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Адрес</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Телефон</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Статус заявки</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Категория</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Дата</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Время</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Способ оплаты</span>: %s
                                </p>
                                <p class="card-text mb-2">
                                    <span>Описание</span>: %s
                                </p>
                            </div>
                            <div class="w-100">
                                <a href="/demo_20251/controllers/update_applicate.php?id=%s&type=confirmed" 
                                class="btn btn-outline-success w-100"
                                title="Изменение статуса заявки на \'Выполнено\'">Выполнено</a>
                            
                                <form action="/demo_20251/controllers/update_applicate.php" method="GET">
                                    <input type="hidden" name="id" value="%s">
                                    <input type="hidden" name="type" value="canceled">
                                    <textarea class="form-control w-100" rows="6" name="info" 
                                            required placeholder="Причина отмены"></textarea>
                                    <button class="btn btn-outline-danger w-100"  title="Изменение статуса заявки на \'Отменено\'">Отменить</button>
                                </form>
                            </div>
                         </div>
                     </div>', 
                     $item['id_application'],
                     $item['surname'], 
                     $item['u_name'], 
                     $item['patronymic'], 
                     $item['address'], 
                     $item['a_phone'],                   
                     $item['status'], 
                     $item['sname'], 
                     $item['date'], 
                     $item['time'], 
                     $item['pname'], 
                     ($item['id_service'] == "1") ? $item['description'] : $item['sname'],
                     $item['id_application'],
                     $item['id_application']);
                 }
             }     
            $data .= "</div>";
        }
        return $data;
    }
    