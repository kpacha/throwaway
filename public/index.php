<?php

	define('BASE_PATH', str_replace('public', '', __DIR__));

	define('APP_PATH', BASE_PATH . 'app/');
	define('CORE_PATH', BASE_PATH . 'core/');

	define('CONFIG_PATH', APP_PATH . 'config/');

	include_once(APP_PATH . 'app.php');

