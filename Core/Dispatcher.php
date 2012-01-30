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
    private $_profiler;
    private $_db = '';

    /**
     * Starts all the dispatcher logic
     * @param int|null $startTime 
     */
    public function __construct($startTime = 0)
    {
        if (DEBUG_MODE) {
            $startTime = ($startTime)?:Pqp_PhpQuickProfiler::getMicroTime();
            $this->_profiler = new Pqp_PhpQuickProfiler($startTime);
            $this->_profillingPoint('Starting the application');
        }

        $this->_routes = $this->_loadRoutes();
    }

    public function __destruct()
    {
        if (DEBUG_MODE) {
            Console::log('Ending the application');
            $this->_profiler->display($this->_db);
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

    /**
     * Shows the content
     * @param Core_Controller $content 
     */
    private function _showContent(Core_Controller $controller)
    {
        if ($controller->getHeaders() && !headers_sent()) {
            foreach ($controller->getHeaders() as $headerString) {
                header($headerString);
            }
        }
        echo $controller->getResponse();
    }

    /**
     * Log the memory and time consumed at this time
     * @param string $message 
     */
    private function _profillingPoint($message = '')
    {
        if (DEBUG_MODE) {
            Console::logMemory();
            Console::logSpeed($message);
        }
    }

    /**
     * Run the application
     */
    public function run()
    {
        try {
            $controller = $this->handle();
            $this->_profillingPoint('Action executed');

            $this->_showContent($controller);
            $this->_profillingPoint('View rendered');
        } catch (Exception $e) {
            if (DEBUG_MODE) {
                Console::logError($e, $e->getMessage());
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        }
    }

    /**
     * Route the request and return the controller with the response
     * @return Core_Controller
     */
    private function handle()
    {
        $route = $this->getRoute($this->_getPath());
        $this->_profillingPoint('Routing the application');
        $controllerName = $route['controller'];
        $actionName = $route['action'];
        $controller = new $controllerName($actionName);
        $this->_profillingPoint('Controller loaded');

        return $controller->handle();
    }

}