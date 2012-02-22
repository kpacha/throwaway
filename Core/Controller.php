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
    private $_headers = null;
    protected $_response = null;

    /**
     * Default costructor
     * @param string $action
     * @param array $params
     */
    public function __construct($action, $params = array())
    {
        $this->_params = $params;

        $actionName = $action . 'Action';
        if (!method_exists($this, $actionName)) {
            throw new Exception("Undefined action! [$actionName]");
        }

        $this->_action = $actionName;
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
     * Get Response header based on its key
     * @param string $key
     * @return string
     */
    public function getHeader($key)
    {
        return ( isset($this->_headers{$key}) ) ? $this->_headers{$key} : null;
    }

    /**
     * Get Response headers
     * @return array
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * Set Response headers
     */
    public function setHeaders($headers)
    {
        if (is_array($headers)) {
            $this->_headers = $headers;
        }
    }

    /**
     * Set Response header
     * @param string $value 
     */
    public function addHeader($value)
    {
        $this->_headers[] = $value;
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
     * @param array $arguments
     * @return Core_Controller
     */
    public function handle($arguments = array())
    {
        $this->_params = array_merge($this->_params, $arguments);
        $this->_preDispatch();
        $this->{$this->_action}($arguments);
        $this->_postDispatch();

        $this->_render();

        return $this;
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

    /**
     * Render the view if the controller did not set a response
     */
    private function _render()
    {
        // Check if the action has set the response instead of using a template
        if (!$this->_response) {
            $this->_response = $this->_getView()->render();
        }
    }

}