<?php
session_name('session_id');
ini_set('session.gc_maxlifetime', 1200);
ini_set('session.cookie_lifetime', 1200);
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/include/functions.php');
$isAuth = false;
$nameVal = '';
$passVal = '';
if(isset($_COOKIE['login'])) {
    $login = $_COOKIE['login'];
    setcookie('login', $login, time() + 60*60*24*30, '/');
}
