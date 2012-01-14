<?php

define('BASE_PATH', str_replace('public', '', __DIR__));

define('APP_PATH', BASE_PATH . 'App/');
define('CORE_PATH', BASE_PATH . 'Core/');

define('CONFIG_PATH', APP_PATH . 'config/');
define('LIBRARY_PATH', BASE_PATH . 'library/');

//define('DEBUG_MODE', false);
define('DEBUG_MODE', true);

include_once(APP_PATH . 'app.php');

