<?php
/**
 * Регистрация скриптов и стилей на странице.
 * для того  что бы зарегистрировать скрипт или
 *
 */

namespace app\assets;

class AppAsset extends AssetBuilder
{
    public static $js = [
        '//code.jquery.com/jquery-3.4.1.slim.min.js',
        '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js',
        '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
        '//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
        '//cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js',
        'js/main.js',
    ];

    public static $css = [
        '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'css/main.css'
    ];


}