<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Error class - using to get or add messages when something went wrong or failed. 
 *
 * @package    core\classes\message
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.09.2015
 */

class Error extends \Message {
    // vars and constants {

        // Describes class type:
        static public $_class = ERROR;

        // Global error messages:
        protected static $_message = array(
            'configuration_file_not_exists'     => 'Configuration file $file not exists',
            'parse_configuration_file_failed'   => 'An Error occurred while reading $file'
        );

    // } methods {
        // public {

        // } protected {

        // } private {

            private function __construct(){} // unable to instantiate this class

        // }
    // }
}// end class "Error"