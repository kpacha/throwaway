<?php

$time = explode(' ', microtime());
define('START_TIME', $time[1] + $time[0]);

define('BASE_PATH', str_replace('public', '', __DIR__));

define('APP_PATH', BASE_PATH . 'App/');
define('CORE_PATH', BASE_PATH . 'Core/');

define('CONFIG_PATH', APP_PATH . 'config/');
define('LIBRARY_PATH', BASE_PATH . 'library/');

//define('DEBUG_MODE', false);
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    error_reporting(E_ALL | E_STRICT);
}

include_once(CORE_PATH . 'Application.php');

$app = new Core_Application();

$app->run();