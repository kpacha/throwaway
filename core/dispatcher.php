<?php

include_once(APP_PATH . "config/routes.php");

$path = $_SERVER['SCRIPT_URL'];

$dispatcher = new Dispatcher();
$route = $dispatcher->getRoute($path);

if (isset($route) && $route != null) {
	
	include_once(APP_PATH . "Controller/" . $route['controller'] . ".php");

	$controllerName = $route['controller'] . 'Controller';
	$actionName = $route['action'] . 'Action';

	$controller = new $controllerName($route['controller'], $route['action']);
	$controller->{$actionName}();

}
