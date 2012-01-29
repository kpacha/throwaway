<?php

/**
 * Description of Application
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Core_Application
{
    /**
     * Autoloader to use
     *
     * @var Core_Autoloader
     */
    protected $_autoloader;

    /**
     * Dispatcher
     *
     * @var Core_Dispatcher
     */
    protected $_dispatcher;

    public function __construct()
    {
        require_once __DIR__ . '/Autoloader.php';
        $this->_autoloader = Core_Autoloader::getInstance();
    }

    /**
     * Get dispatcher object
     *
     * @return Core_Dispatcher
     */
    public function getDispatcher()
    {
        if (null === $this->_dispatcher) {
            $this->_dispatcher = new Core_Dispatcher();
        }
        return $this->_dispatcher;
    }

    /**
     * Run the application
     *
     * @return void
     */
    public function run()
    {
        $this->getDispatcher()->run();
    }

}

?>
