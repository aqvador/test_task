<?php

use app\assets\AppAsset;

$this->title = 'Авторизация пользователя';
AppAsset::registerJs('js/auth.js');
AppAsset::registerCss('css/auth.css');

?>

<div class="form">

    <ul class="tab-group">
        <li class="tab active"><a href="#signup">Регистрация</a></li>
        <li class="tab"><a href="#login">Вход</a></li>
    </ul>

    <div class="tab-content">
        <div id="signup">
            <form action="/" method="post" id="formSignUp">
                <!--Против автозаполнения-->
                <div class="d-none">
                    <input type="email" name="email">
                    <input type="password" name="password">
                </div>

                <div class="top-row">
                    <div class="field-wrap">
                        <label>Фамилия<span class="req">*</span></label>
                        <input type="text" name="lastName" autocomplete="off"/>
                    </div>

                    <div class="field-wrap">
                        <label>Имя<span class="req">*</span></label>
                        <input type="text" name="name" autocomplete="off"/>
                    </div>
                </div>

                <div class="field-wrap">
                    <label>Email<span class="req">*</span></label>
                    <input type="email" name="email" autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>Пароль<span class="req">*</span> </label>
                    <input type="password" class="password" name="password" autocomplete="off">
                </div>

                <div class="field-wrap">
                    <label>Еще раз пароль<span class="req">*</span> </label>
                    <input type="password" name="confirmPassword" autocomplete="off">
                </div>

                <button type="submit" class="button button-block">Регистрация</button>
            </form>
        </div>

        <div id="login">
            <form action="/" method="post" id="formLogin">
                <!--Против автозаполнения-->
                <div class="d-none">
                    <input type="email" name="email">
                    <input type="password" name="password">
                </div>

                <div class="field-wrap">
                    <label>Email<span class="req">*</span></label>
                    <input type="email" name="email" autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>Пароль<span class="req">*</span></label>
                    <input type="password" name="password" autocomplete="off"/>
                </div>

                <button class="button button-block text-center">Войти</button>

            </form>

        </div>

    </div><!-- tab-content -->

</div> <!-- /form -->
