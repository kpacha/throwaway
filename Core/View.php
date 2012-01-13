<?php

/**
 * Core_View Class
 * 
 * @version 0.1 
 * @author Adrià Cidre [adria.cidre@gmail.com]
 */
class Core_View
{

    protected $_controller = null;
    protected $_layout = 'default';
    protected $_params = null;
    protected $_render = null;

    /**
     * 
     */
    public function __construct($controller = null)
    {
        $this->_controller = $controller;
    }

    /**
     *  Return path's spacified template as string
     * 
     *  @param string $path
     *  @return string
     */
    public function load($path = '')
    {
        return $this->_getTemplate($path);
    }

    /**
     * Render the specified file as string and return
     * it encapsulated on the default layout
     * 
     * @param string $path
     * @return string
     */
    public function render($path = '', $params = array())
    {
        $params = array_merge($this->_params, $params);
        return $this->renderLayout(
                        array_merge(
                                array('content' => $this->_getTemplate($path, $params)), $params
                        )
        );
    }

    /**
     * Get a response param by key
     * 
     * @param string $key
     * @return string
     */
    public function getParam($key)
    {
        return $this->_controller->getParam($key);
    }

    /**
     * Set response params
     * @param string $name
     * @param mixed $value 
     */
    public function setParam($name, $value)
    {
        $this->_params[$name] = $value;
    }

    /**
     * Renders a given layout with specified content
     * 
     * @param array $data
     * @return string
     */
    public function renderLayout($data = array())
    {
        return $this->_includePath(APP_PATH . "View/layouts/" . $this->_layout . ".phtml", $data);
    }

    /**
     * Get the template for a specified path
     * 
     * @param string $path
     * @param array $data
     * @return string
     */
    private function _getTemplate($path, $data = array())
    {
        return $this->_includePath(
                        APP_PATH . "View/" . ( ($path) ? : $this->_controller->getAction() ) . ".phtml", $data
        );
    }

    /**
     * Include a specified path
     * 
     * @param string $path
     * @param array $data
     * @return string
     */
    private function _includePath($path, $data = array())
    {
        $content = '';
        extract($data);

        if (is_file($path) && is_readable($path)) {
            ob_start();
            include_once($path);
            $content = ob_get_contents();
            ob_end_clean();
        }

        return $content;
    }

}