<?php
    if (isAuth()) {
    header('Refresh: 2; URL=/?login=yes'); ?>
    <div>
        <h1>Требуется авторизация</h1>
        <p>Доступ на эту страницу запрещен неавторизованным пользователям.</p>
    </div><?php
    exit;
}
