<?php


class Core_Dispatcher 
{
	protected $_routes = array();


	/**
	 * Starts all the dispatcher logic
	 */
	public function __construct() 
	{
		$this->_routes = $this->_loadRoutes();

		$route = $this->getRoute($_SERVER['SCRIPT_URL']);

		if (isset($route) && $route != null) {

			$controllerName = $route['controller'];
			$actionName = $route['action'] . 'Action';

			$controller = new $controllerName($route['action']);
			$controller->{$actionName}();

		}
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

	private function _loadRoutes()
	{
		return json_decode(file_get_contents(CONFIG_PATH . 'routes.json'), true);
	}
}