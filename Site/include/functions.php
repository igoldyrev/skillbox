<?php

function sortDescTitle($x, $y) {
    return $x['title'] < $y['title'];
}

function sortAscSort($x, $y) {
    return $x['sort'] > $y['sort'];
}

function cutString($line, $length = 12, $appends = '...'): string
{
    $line = mb_strlen($line, 'UTF-8') > $length ? mb_substr($line, 0, $length, 'UTF-8') . $appends : $line;

    return $line;
}

function showMenu($arr,$sortBy = 'sortAscSort', $ulClass = '') {
    
    $styleClass = $sortBy == 'sortAscSort' ? 'main-menu__top' : 'main-menu__bottom';
    
    usort($arr, $sortBy);
    
    include ($_SERVER['DOCUMENT_ROOT'].'/templates/menuTemplate.php');
}

function getTitle($arr) {
    
    foreach ($arr as $items) {

        if(isCurrentUrl($items['path'])) {

            return $items['title'];
        }
    }

    return '';
}

function isCurrentUrl($url) {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $url;
}

function connect() {
    $host="localhost";
    $user="root";
    $password="TYSon777";
    $dbname="project";
    static $con;

    if(empty($con)) {
        $con = mysqli_connect($host, $user, $password, $dbname)
        or die ('Нет соединения с сервером ' . mysqli_connect_error());
    }

    if(!$con -> set_charset("utf-8")) {
        mysqli_error($con);
    } else {
        mysqli_character_set_name($con);
    }

    return $con;
}

function isAuth() {
    return empty($_SESSION['login']);
}

function getUserByLogin($login) {
    $userQuery = "SELECT fio, email, password FROM users WHERE fio = '" . mysqli_real_escape_string(connect(),  $login) . "' OR email = '" . mysqli_real_escape_string(connect(),  $login) . "'";
    return $userQuery;
}

function isModerUser($fio) {
    $queryUserRole = "select count(g.name) from `groups` as g
    join group_user gu on g.id = gu.group_id
    join users u on gu.user_id = u.id
    where u.fio ='" . mysqli_real_escape_string(connect(), $fio) . "'";

    if($resUserRole = mysqli_query(connect(), $queryUserRole)) {
        $row = mysqli_fetch_assoc($resUserRole);

        return $row['count(g.name)'] == '2';
    }
}

function showUserInfo($fio, $email, $phone) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/showUserInfoTemplate.php');
}

function getUserInfoByLogin($fio) {
    $queryUserInfo = "select u.fio, u.email, u.phone from users as u 
                    where u.fio = '" .mysqli_real_escape_string(connect(),  $fio) . "'";

    if($resUserInfo = mysqli_query(connect(), $queryUserInfo)) {
        while ($row = mysqli_fetch_assoc($resUserInfo)) {
            showUserInfo($row['fio'], $row['email'], $row['phone']);
        }
    }
}

function showUserGroups($name) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/showUserGroupsTemplate.php');
}

function getUserGroupsByLogin($fio) {
    $queryUserGroups = "select g.name from `groups` as g
                    join group_user gu on g.id = gu.group_id
                    join users as u on gu.user_id = u.id
                    where u.fio = '" . mysqli_real_escape_string(connect(),  $fio) . "'"; ?>

    <p>Группы пользователя</p><?php
    if($resUserGroups = mysqli_query(connect(), $queryUserGroups)) {
        while ($row = mysqli_fetch_assoc($resUserGroups)) {
            showUserGroups($row['name']);
        }
    }
}

function showMessagesByLogin($id, $sender_fio, $title, $text) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/showMessagesByLoginTemplate.php');
}

function getMessagesByLogin($fio, $read) {
    $queryUserMessages = "select m.id, m.title, m.text, m.is_read, sender.fio as sender_fio, u.fio as post_fio from `messages` as m
    join users u on m.user_send = u.id
    join users as sender ON m.user_post = sender.id
    where u.fio = '" . mysqli_real_escape_string(connect(),  $fio) . "' and m.is_read = $read ";

    if($resUserMessages = mysqli_query(connect(), $queryUserMessages)) {
        while ($row = mysqli_fetch_assoc($resUserMessages)) {
            showMessagesByLogin($row['id'], $row['sender_fio'], $row['title'], $row['text']);
        }
    }
}

function showMessage($title, $created_at, $fio, $email, $text) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/showMessageTemplate.php');
}

function getMessageById($id) {
    $queryMessage = "select m.title, m.created_at, m.user_post, m.text, u.email, u.fio, m.is_read from messages as m
join users u on m.user_post = u.id
where m.id ='" . mysqli_real_escape_string(connect(),  $id) . "'";

    if($resMessage = mysqli_query(connect(), $queryMessage)) {
        while ($row = mysqli_fetch_assoc($resMessage)) {
            showMessage($row['title'], $row['created_at'], $row['fio'], $row['email'], $row['text']);
        }
    }
}

function setMessageIsRead($id) {
    $queryUpdateMessage = "update messages set is_read = 1 where id ='". mysqli_real_escape_string(connect(),  $id) . "'";
    mysqli_query(connect(), $queryUpdateMessage);
}

function showUserSendMessage($id, $fio) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/showUserSendMessageTemplate.php');
}

function getUsersSendMessage($fio) {
    $queryGetUsers = "select u.id, u.fio from users u
    join group_user gu on u.id = gu.user_id
    join `groups` g on gu.group_id = g.id
    where g.name = 'Пользователь имеющий право писать сообщения'
    and u.fio != '" . mysqli_real_escape_string(connect(),  $fio) . "'";

    if($resUsers = mysqli_query(connect(), $queryGetUsers)) {
        while ($row = mysqli_fetch_array($resUsers)) {
            showUserSendMessage($row['id'], $row['fio']);
        }
    }
}

function showUserGroupsMessage($id, $name, $code) {
    include($_SERVER['DOCUMENT_ROOT'] . '/templates/showUserGroupsMessageTemplate.php');
}

function getGroupsMessages() {
    $queryGetGroupsMessages = "select s.id, s.name, s.parent_id, c.code from sections s
join colors c on c.id = s.color_id";

    if($resGroups = mysqli_query(connect(), $queryGetGroupsMessages)) {
        while ($row = mysqli_fetch_assoc($resGroups)) {
            showUserGroupsMessage($row['id'], $row['name'], $row['code']);
        }
    }
}

function getUseridFromLogin($fio) {
    $queryUserId = "select u.id from users u where u.fio ='". mysqli_real_escape_string(connect(),  $fio) . "'";
    if($resUserId = mysqli_query(connect(), $queryUserId)) {
        while ($row = mysqli_fetch_assoc($resUserId)) {
            return $row['id'];
        }
    }
}

function sendMessage($fio) {
    if(isset($_POST['title']) && $_POST['title'] != "" && isset($_POST['text']) && $_POST['text'] != "") {
        $messageTitle = htmlspecialchars(urldecode(trim($_POST['title'])));
        $messageText = htmlspecialchars(urldecode(trim($_POST['text'])));
        $messageUser = htmlspecialchars(urldecode(trim($_POST['user'])));
        $messageSection = htmlspecialchars(urldecode(trim($_POST['section'])));

        $userSendId = getUseridFromLogin($fio);
        $queryInsertMessage = "insert into messages (title, text, created_at, user_send, user_post, is_read, section_id) VALUES ('". $messageTitle . "','" . $messageText . "', now(),'" . $userSendId . "','" . $messageUser . "', 0, '" . $messageSection . "');";

        mysqli_query(connect(), $queryInsertMessage);
    }
}
