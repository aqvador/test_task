<?php

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

require_once '../vendor/autoload.php';

$conf = require_once '../config/web.php';

(new \app\engine\App($conf))->run();