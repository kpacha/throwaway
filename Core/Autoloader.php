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

    public function __construct()
    {
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className)
    {
        $path = implode("/", explode("_", $className));

        if (file_exists(BASE_PATH . $path . '.php')) {
            require_once BASE_PATH . $path . '.php';
        } elseif (file_exists(LIBRARY_PATH . $path . '.php')) {
            require_once LIBRARY_PATH . $path . '.php';
        } else {
            throw new Exception("Class $className not found! Looking for $path");
        }
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
