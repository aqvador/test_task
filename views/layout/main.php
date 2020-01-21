<?php
/**
 * @var $content
 */

use app\assets\AppAsset;

?>


<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= AppAsset::buildCss() ?>
    <title><?= $this->title ?></title>

</head>
<body>
<?php

$this->renderPartial('@header');
?>
<?= $content; ?>
<?php $this->renderPartial('@footer'); ?>
<?= AppAsset::buildJs() ?>
</body>
</html>