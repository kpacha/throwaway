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
	private $_response = null;

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
	 * Set Request params
	 */
	public function setParams($params)
	{
                if (is_array($params)) {
                    $this->_params = $params;
                }
	}

	/**
	 * Set Request params
         * @param string $name
         * @param mixed $value 
         */
	public function setParam($name, $value)
	{
		$this->_params[$name] = $value;
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


	/**
	 * Get private value of response
	 * @return string
	 */
	public function getResponse()
	{
		if ($this->_response === null) {
			$this->_response = '';
		}

		return $this->_response;
	}


	/**
         * Call the requested action
         * @param string $actionName
         * @param mixed $arguments
	 * @return string
         */
	public function __call($actionName, $arguments)
	{
                $actionName .= 'Action';
                if(method_exists($this, $actionName))
                {
                    $this->_preDispatch();
                    $this->{$actionName}();
                    $this->_postDispatch();
                    
                    $this->_response = $this->_getView()->render();
                }

		return $this->getResponse();
	}
        
        /**
         * Default predispatch action
         */
        public function _preDispatch()
        {
        }
        
        /**
         * Default postdispatch action
         */
        public function _postDispatch()
        {
        }
}