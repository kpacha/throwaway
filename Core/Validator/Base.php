<?php

/**
 * Description of Base
 *
 * @author Adrià Cidre <adria.cidre@gmail.com>
 */

class Core_Validator_Base 
{
    protected $_typeValidator = null;
    protected $_valueValidator = null;
    protected $_validators = null;
    protected $_validatorMethods = null;


    /**
     * Constructor defines all validators to be used
     */
    public function __construct()
    {
        $this->_validators = array(
            'Core_Validator_Type' => null,
            'Core_Validator_Value' => null
        );
        
        $this->_indexAllValidatorMethods();
    }
    
    
    /**
     * Magic method Call
     * @param string $method
     * @param array $arguments 
     */
    public function __call($method, $arguments)
    {
        $validator = $this->_getValidator($method);
        return $validator->$method($arguments);
    }
    

    /**
     * Get the validator object for a given method
     * @param string $method
     * @return object
     */
    private function _getValidator($method)
    {
        $validator = $this->_validatorMethods[$method];
        
        if ($this->_validators[$validator] === null) {
            $this->_validators[$validator] = new $validator();
        }
        
        return $this->_validators[$validator];
    }

    
    /**
     * Index all validator methods on an array
     */
    private function _indexAllValidatorMethods()
    {
        while (list($class, $value) = each($this->_validators)) {
            $methods = get_class_methods($class);
            for($i = 0; $i<count($methods); $i++) {
                $this->_validatorMethods[$methods[$i]] = $class;
            }
        }
    }

}
