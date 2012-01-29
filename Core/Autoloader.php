<?php

/**
 * Description of Autoloader
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
class Core_Autoloader
{

    /**
     * @var Core_Autoloader Singleton instance
     */
    protected static $_instance;

    /**
     * @var array The included paths
     */
    protected $_includePaths;

    public function __construct()
    {
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className)
    {
        $path = implode("/", explode("_", $className));

        foreach ($this->getIncludePaths() as $base) {
            if (file_exists($base . $path . '.php')) {
                require_once $base . $path . '.php';
                return;
            }
        }
        throw new Exception("Class $className not found! Looking for $path");
    }

    private function getIncludePaths()
    {
        if ($this->_includePaths === null) {
            $this->_includePaths = array(BASE_PATH, LIBRARY_PATH);
        }
        return $this->_includePaths;
    }

    /**
     * Retrieve singleton instance
     *
     * @return Core_Autoloader
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}

?>
