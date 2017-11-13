<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Warning class - using to get or add messages when everything is ok and works properly, 
 * but something out of proper functioning went wrong or failed. 
 *
 * @package    core\classes\message
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.09.2015
 */

class Warning extends \Message {
    // vars and constants {
        
        // Describes class type:
        static public $_class = WARNING;
        
        // Global warning messages:
        protected static $_message = array(
            
        );
        
    // } methods {
        // public {
        
        // } protected {
        
        // } private {
        
            private function __construct(){} // unable to instantiate this class
            
        // }
    // }
}// end class "Warning"