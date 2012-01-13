<?php

/**
 * Description of Type
 *
 * @author Adrià Cidre <adria.cidre@gmail.com>
 */
class Core_Validator_Type 
{
    /**
     * Checks if the given value is a string
     * @param mixed $arg
     * @return boolean
     */
    final public function isString($arg)
    {
        // FIXME Define correct rules for this validation
        return is_string($arg);
    }
    
    
    /**
     * Checks if a given value is a float
     * @param mixed $arg
     * @return boolean 
     */
    final public function isFloat($arg)
    {
        // FIXME Define correct rules for this validation
        return is_float($arg);
    }

    
    /**
     * Checks if the given value is an integer
     * @param mixed $arg
     * @return boolean 
     */
    final public function isInteger($arg)
    {
        // FIXME Define correct rules for this validation
        return is_int($arg);
    }
    
    
    /**
     * Checks if the given value is a boolean
     * @param mixed $arg
     * @return boolean 
     */
    final public function isBoolean($arg)
    {
        // FIXME Define correct rules for this validation
        return is_bool($arg);
    }


    /**
     * Checks if the given value is an array
     * @param mixed $arg
     * @return boolean 
     */
    final public function isArray($arg)
    {
        // FIXME Define correct rules for this validation
        return is_array($arg);
    }

    
    /**
     * Checks if the given value is an object
     * @param mixed $arg
     * @return boolean 
     */
    final public function isObject($arg)
    {
        // TODO Add correct validations
        return is_object($arg);
    }   
}
