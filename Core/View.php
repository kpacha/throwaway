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

	/**
	 * 
	 */
	public function __construct($controller = null)
	{
		$this->_controller = $controller;
	}

	/**
	 *  Return path's spacified file as string
	 * 
	 *  @param string $path
	 *  @return string
	 */
	public function load($path = '') 
	{
		return $this->_getContent($path);
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
		return $this->renderLayout(
			array_merge(
				array('content' => $this->_getContent($path)),
				$params
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
	 * Renders a given layout with specified content
	 * 
	 * @param $content mixed
	 * @return string
	 */
	public function renderLayout($data)
	{
		extract($data);

		ob_start();
		include_once(APP_PATH . "View/layouts/" . $this->_layout . ".phtml");
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	/**
	 * Get the content for a specified path
	 * 
	 * @param string $path
	 * @return string
	 */
	private function _getContent($path)
	{
		ob_start();
		include_once(APP_PATH . "View/" . ( ($path == '') ? $this->_controller->getAction() : $path ) . ".phtml");
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

}