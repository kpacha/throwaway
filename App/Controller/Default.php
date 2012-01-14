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

    public function jsonTestAction()
    {
        $this->addHeader('Content-type: application/json');
        $mock = new stdClass();
        $mock->prop1 = 1;
        $mock->prop2 = 'demo';
        $mock->prop3 = array('impressive', 'awesome', 'crazy', 'easy');
        $mock->prop4 = 9.9;
        $mock->check = "ñandú complain well /escaped. Very easy, isn't it?";
        $this->_response = json_encode($mock);
    }

}
