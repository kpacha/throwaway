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

		if (empty($route)) {
			header ("HTTP/1.0 404 Not Found");
                        return;
		}
                
                $controllerName = $route['controller'];
                $actionName = $route['action'];

                $controller = new $controllerName($actionName);
                echo $controller->{$actionName}();
	}

	/**
	* Return the specified route to given path
	* @param string $path
	* @return mixed
	*/
	public function getRoute($path) 
	{
		if (is_string($path) && isset($this->_routes[$path])) {
			return $this->_routes[$path];
		} else {
			return null;
		}
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