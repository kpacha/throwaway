<?php


class Dispatcher 
{
	protected $_routes = array(
		"/" => array(
			"controller" 	=> "default",
			"action" 		=> "default",
		)
	);

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
}