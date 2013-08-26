<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

$inc_dir = dirname(__FILE__).'/protected/phplib/';
require_once($inc_dir.'array_column.php');
require_once($inc_dir.'RestCurlClient.php');
require_once($inc_dir.'QratitudeHelper.php');

Yii::createWebApplication($config)->run();
