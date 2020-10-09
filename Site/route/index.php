<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/session_header.php');
include ($_SERVER['DOCUMENT_ROOT'].'/include/unauthorized.php');
include ($_SERVER['DOCUMENT_ROOT'].'/include/auth.php');
include ($_SERVER['DOCUMENT_ROOT'].'/include/main_menu.php');
include ($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

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

                <?php

                    if(!empty($_GET['login']) && $_GET['login'] == 'yes') { ?>
                        <div class="index-auth">
                            <form action="/index.php?login=yes" method="post">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <?php
                                    if(!isset($_COOKIE['login'])) { ?>

                                        <tr>
                                            <td class="iat">
                                                <label for="login_id">Ваш e-mail:</label>
                                                <input id="login_id" size="30" name="login" value="<?=htmlspecialchars($nameVal); ?>">
                                            </td>
                                        </tr><?php
                                    } else { ?>
                                        <div class="auth-login-wrap">
                                            <span class="auth-login">Ваш логин </span>
                                            <span class="auth-login auth-login--dotted"><?=$_COOKIE['login'] ?></span>
                                        </div><?php
                                    }
                                    if(!isset($_SESSION['auth'])) { ?>

                                        <tr>
                                            <td class="iat">
                                                <label for="password_id">Ваш пароль:</label>
                                                <input id="password_id" size="30" name="password" type="password" value="<?=$passVal; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input name="auth" type="submit" value="Войти"></td>
                                        </tr><?php
                                    } ?>
                                </table>
                            </form>
                            <?php
                            if(isset($_POST['auth'])) {

                                if($isAuth) {
                                    include ($_SERVER['DOCUMENT_ROOT'].'/include/success.php');
                                } else {
                                    include ($_SERVER['DOCUMENT_ROOT'].'/include/error.php');
                                }

                            } ?>

                        </div>
                   <?php }
                    if(!empty($_GET['logout']) && $_GET['logout'] == 'yes') {
                        $_SESSION['login'] = '';
                        session_destroy();
                    } ?>
            </td>
        </tr>
    </table>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
