<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/session_header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/unauthorized.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/auth.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php');
include($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');

if(isset($_POST['sendMsgForm'])) {
    sendMessage($_SESSION['login']);
    return;
} ?>

            <td class="right-collum-index">
                <div class="project-folders-menu">
                    <ul class="project-folders-v">
                        <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/authTemplate.php'); ?>
                        <li class="project-folders-v-active"><a href=<?=$authLink?>><?=$authName?></a></li>
                        <li><a href="#">Регистрация</a></li>
                        <li><a href="#">Забыли пароль?</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </td>
        </tr>
    </table>

    <div class="center-block">
        <h1 class="center-block__title">Отправить сообщение</h1>
        <?php
        if(isModerUser($_SESSION['login'])) { ?>
            <form class="message__form" action="" method="post">
                <input type="text" name="title" required class="input message__input" placeholder="Заголовок сообщения">
                <textarea name="text" required class="textarea message__input" placeholder="Текст сообщения"></textarea>
                <select name="user" size="1" class="select message__input">
                    <option value="0" selected>Выберите пользователя</option>
                    <?php getUsersSendMessage($_SESSION['login']); ?>
                </select>
                <select name="section" size="1" class="select message__input">
                    <option value="0" selected>Выберите раздел сообщения</option>
                    <?php getGroupsMessages(); ?>
                </select>
                <input type="submit" name="sendMsgForm" value="Отправить">
            </form><?php
        } else {
            include($_SERVER['DOCUMENT_ROOT'] . '/templates/moderateMessageTemplate.php');
        } ?>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'); ?>

