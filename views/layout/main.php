<head>
    <title><?=$this->title?></title>
</head>

<h1><?=$this->title?></h1>
<?php
/**
 * @var $content
 */
$this->renderPartial('@header');
?>
<h4>---START CONTENT---</h4>
<?= $content; ?>
<h4>---STOP CONTENT---</h4>
<?php $this->renderPartial('@footer'); ?>

