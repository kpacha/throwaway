<?php

/**
 * Default controller
 * 
 * Example default controller
 * 
 * @version 0.1 
 * @author Adrià Cidre [adria.cidre@gmail.com]
 */

class App_Controller_Default extends Core_Controller 
{
	public function defaultAction()
	{
		$this->_getView()->setParam('title', 'Hello world Title');
	}
}
