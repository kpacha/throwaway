<?php

	define('BASE_PATH', str_replace('public', '', __DIR__));
	define('APP_PATH', BASE_PATH . 'app/');
	define('CORE_PATH', BASE_PATH . 'core/');

	include_once(APP_PATH . 'app.php');

