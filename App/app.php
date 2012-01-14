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

    if (file_exists(BASE_PATH . $path . '.php')) {
        require_once BASE_PATH . $path . '.php';
    } elseif (file_exists(LIBRARY_PATH . $path . '.php')) {
        require_once LIBRARY_PATH . $path . '.php';
    } else {
        throw new Exception("Class $className not found! Looking for $path");
    }
}

new Core_Dispatcher();
