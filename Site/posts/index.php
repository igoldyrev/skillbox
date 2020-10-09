<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/session_header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/unauthorized.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/auth.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php');
include($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'); ?>

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
        <a href="/posts/add.php">Написать сообщение</a>
        <?php
        $userLogin = $_SESSION['login'];

        if(empty($_GET['message'])) {
            if(isModerUser($userLogin)) { ?>
                <div class="message__wrapper">
                <div class="message__block">
                    <p>Непрочитанные сообщения</p>
                    <?php getMessagesByLogin($userLogin, 0) ?>
                </div>
                <div class="message__block">
                    <p>Прочитанные сообщения</p>
                    <?php getMessagesByLogin($userLogin, 1) ?>
                </div>
                </div><?php
            } else {
                include($_SERVER['DOCUMENT_ROOT'] . '/templates/moderateMessageTemplate.php');
            }
        } else {
            getMessageById($_GET['message']);
            setMessageIsRead($_GET['message']);
        } ?>
        <a href="/posts/">Назад к сообщениям</a>
        <a href="/posts/add.php">Написать сообщение</a>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'); ?>
