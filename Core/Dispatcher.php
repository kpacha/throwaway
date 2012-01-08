<?php

/**
 * Core Dispatcher
 * 
 * @version 0.1 
 * @author Adrià Cidre [adria.cidre@gmail.com]
 */
class Core_Dispatcher
{

    protected $_routes = array();

    /**
     * Starts all the dispatcher logic
     */
    public function __construct()
    {
        $this->_routes = $this->_loadRoutes();

        $route = $this->getRoute($this->_getPath());

        try {
            $controllerName = $route['controller'];
            $actionName = $route['action'];
            $controller = new $controllerName($actionName);
            echo $controller->{$actionName}();
        } catch (Exception $e) {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /**
     * Return the specified route to given path
     * @param string $path
     * @return array|null
     */
    public function getRoute($path)
    {
        if (is_string($path) && isset($this->_routes[$path])) {
            $route = $this->_routes[$path];
        } else {
            $requestedPath = explode('/', $path);
            $route['controller'] = 'App_Controller_' . (($requestedPath[1]) ? ucfirst($requestedPath[1]) : 'Default');
            $route['action'] = (isset($requestedPath[2])) ? $requestedPath[2] : 'default';
        }
        return $route;
    }

    /**
     * Load routes from external file default 
     * is app/config/routes.json
     * @return array
     */
    private function _loadRoutes()
    {
        return json_decode(file_get_contents(CONFIG_PATH . 'routes.json'), true);
    }

    /**
     * Get the 'cleaned' requested uri
     * @return string the requested uri without the index.php part 
     */
    private function _getPath()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $path = $requestUri['path'];
        if (strlen($path) > 1) {
            $path = rtrim($path, '/');
        }
        return str_replace('//', '/', str_replace('index.php', '', $path));
    }

}