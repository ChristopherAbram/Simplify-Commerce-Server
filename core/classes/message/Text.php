<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Text class - using to get plain text not connected with displauing communiques. 
 *
 * @package    core\classes\message
 * @author     Christopher Abram
 * @version    1.0
 * @date	05.09.2015
 */

class Text extends \Message {
    // vars and constants {

        // Describes class type:
        static public $_class = TEXT;
        
        // Global correct messages:
        protected static $_message = array(

        );

    // } methods {
        // public {

            /* Gets message string indicated by msg_id, this function is aware of the context which have been called in.
             * This means that we do not have to give such parameters as: package_id, message_type and lang_id to indicate 
             * message string more closely - becouse it is a result of the fact, that function is aware of the context, thus 
             * knows which message string to choose.
             * @params: 
             *  (string/int/float/double) $msg_id - message ID.
             *  string $package_id - true when we are refering to local package (default). Otherwise give string indicating proper package_id.
             * @return: string - output message string or specified message if ID does not exist (or empty string).
             * @throws: -
            **/
            /*static public function get( $msg_id ){
                    // package_id setting: 
                    $package_id = self::_indicatePackageID( );
                    if( $package_id === '' || $package_id === NULL )
                            $package_id = \core\classes\languages\Lang::usingPackage( );

                    // lang_id setting:
                    $lang_id = \core\classes\languages\Lang::getDisplayLanguage( );

                    // msg_type setting:
                    $msg_type = static::$_class;

                    return \core\classes\languages\Lang::getMessageNS( $package_id, $msg_type, $lang_id, $msg_id );
            }// end method "get"*/

        // } protected {
        
        // } private {
        
            private function __construct(){} // unable to instantiate this class
            
        // }
    // }
}// end class "Text"