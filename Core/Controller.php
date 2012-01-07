<?php

/**
 * Controller Class
 * 
 * @version 0.1 
 * @author Adrià Cidre [adria.cidre@gmail.com]
 */
 
class Core_Controller
{
	private $_action = null;
	private $_view = null;
	private $_params = null;

	/**
	 * Default costructor
	 * @param string $action
	 */
	public function __construct($action)
	{
		$this->_params = $_REQUEST;
		$this->_action = $action;
	}


	/**
	 * Get Request param based on its key
	 * @param string $key
	 * @return mixed
	 */
	public function getParam($key)
	{
		return ( isset($this->_params{$key}) ) ? $this->_params{$key} : null;
	}

	/**
	 * Get Request params
	 * @return array
	 */
	public function getParams()
	{
		return $this->_params;
	}


	/**
	 * Get the requested action
	 * @return string
	 */
	public function getAction()
	{
		return $this->_action;
	}


	/**
	 * Get private value of view
	 * @return Core_View
	 */
	protected function _getView()
	{
		if ($this->_view === null) {
			$this->_view = new Core_View($this);
		}

		return $this->_view;
	}
}