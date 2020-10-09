<?php
$authLink = !isAuth() ? '/?logout=yes' : '/?login=yes';
$authName = !isAuth() ? 'Выйти' : 'Авторизация';
