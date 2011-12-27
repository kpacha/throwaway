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
		echo $this->_getView()->render('', array('title' => 'Hello world Title'));
	}
}
