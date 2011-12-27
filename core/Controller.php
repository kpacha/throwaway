<?php

/**
 * Controller Class
 * 
 * @version 0.1 
 * @author Adrià Cidre [adria.cidre@gmail.com]
 */
 
class Core_Controller
{
	protected $_action;
	protected $_view;
	protected $_params;

	/**
	 * Default costructor
	 * @param string $action
	 */
	public function __construct($action)
	{
		$this->_params = $_REQUEST;
		$this->_action = $action;
		$this->_view = new Core_View($this);
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
}