<?php

/**
 * 
 * @version 0.1 
 * @author Adrià Cidre [adria.cidre@gmail.com]
 */


/**
 * Magic method autoload
 * That autoloads all functions based files
 * on its class Name
 * 
 * @param string $className
 */
function __autoload($className) 
{
	$path = implode("/", explode("_", $className));

	require_once BASE_PATH . $path . '.php';
}

new Core_Dispatcher();
