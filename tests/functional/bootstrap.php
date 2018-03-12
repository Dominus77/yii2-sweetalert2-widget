<?php

error_reporting(E_ERROR | E_PARSE | E_NOTICE);
define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);
$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;
require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
Yii::setAlias('@tests', __DIR__);
require_once(__DIR__ . '/TestCase.php');
