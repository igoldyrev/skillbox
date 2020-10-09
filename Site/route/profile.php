<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/session_header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/unauthorized.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/auth.php');
include($_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php');
include($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'); ?>

            <td class="right-collum-index">
                <div class="project-folders-menu">
                    <ul class="project-folders-v">
                        <?php
                        $authLink = !empty($_SESSION['login']) ? '/?logout=yes' : '/?login=yes';
                        $authName = !empty($_SESSION['login']) ? 'Выйти' : 'Авторизация';
                        ?>
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
        <?php
        getUserInfoByLogin($_SESSION['login']);
        getUserGroupsByLogin($_SESSION['login']); ?>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'); ?>
