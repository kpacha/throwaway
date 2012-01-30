<?php

/**
 * Description of PhpQuickProfiler
 *
 * @author Kpacha <kpacha666@gmail.com>
 */
require_once __DIR__ . '/pqp/classes/PhpQuickProfiler.php';

class Pqp_PhpQuickProfiler extends PhpQuickProfiler
{

    public function __construct($startTime, $config = '/pqp/')
    {
        $GLOBALS['debugger_logs'] = array(
            'logCount' => 0,
            'memoryCount' => 0,
            'errorCount' => 0,
            'speedCount' => 0
        );
        parent::__construct($startTime, $config);
    }

}

?>
