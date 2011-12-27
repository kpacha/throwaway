<?php

/**
 * Default controller
 * 
 * Example default controller
 * 
 * (c) Adrià Cidre [adria.cidre@gmail.com]
 */

class defaultController extends Core_Controller 
{
	public function defaultAction()
	{
		echo $this->_view->render('', array('title' => 'Hello world Title'));
	}
}
