<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Message package
 *
 * @package    core\classes\message
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.09.2015
 */

abstract class Message {
    // vars and constants {

        // Describes class type:
        static public $_class = CORRECT;

        // Message container:
        static protected $_message = array();

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
                            $package_id = __GLOBAL__;//\core\classes\languages\Lang::usingPackage( );

                    // lang_id setting:
                    $lang_id = \core\classes\languages\Lang::getDisplayLanguage( );

                    // msg_type setting:
                    $msg_type = static::$_class;

                    return \core\classes\languages\Lang::getMessage( $package_id, $msg_type, $lang_id, $msg_id );
            }// end method "get"*/
            public static function get($msg_id){
                if(isset(static::$_message[$msg_id])){
                    return static::$_message[$msg_id];
                }
                return '';
            }// end get


            /* Gets all parameters connected with message.
             * @params: (string/int/float/double) $msg_id - message ID.
             * @return: array - Returns associative array containing keys: package, class and message.
             * @throws: -
            **/
            static public function getMessageContext( $msg_id ){
                    // package_id setting: 
                    $package_id = self::_indicatePackageID( );
                    if( $package_id === '' || $package_id === NULL )
                            $package_id = __GLOBAL__;//\core\classes\languages\Lang::usingPackage( );

                    // lang_id setting:
                    $lang_id = \core\classes\languages\Lang::getDisplayLanguage( );

                    // msg_type setting:
                    $msg_type = static::$_class;

                    return array(
                            'package'	=> $package_id,
                            'class'		=> $msg_type,
                            'message'	=> \core\classes\languages\Lang::getMessage( $package_id, $msg_type, $lang_id, $msg_id ),
                    );
            }// end method "getMessageContext"

            /* Replaces occurring key with appropriate replacement in given string $subject
             * @params:
             *  string $subject - subject.
             *  array $replacement - associative array containing keys occurring in string which will be replaced with assigned to this key values.
             * @return: string - string after replacing all keys in array $replacement.
             * @throws: -
            **/
            final static public function replace( $subject, array $replacement ){
                    foreach( $replacement as $key => $value ){
                            $key = preg_replace( '/\x24/i', "\\\\$", $key );
                            $subject = preg_replace( '/'.$key.'/i', $value, $subject );
                    }
                    return $subject;
            }// end method "replace"

        // } protected {
			
			/* Indicates package ID using backtrace array. Notice: The function is not able to indicate namespace 
			 *	when another function calling it - is not called from any function or callback.
			 *  This is because, to guess namespace name where, for example function: Message::get(), has been called in,
			 *  there is required additional frame on the calling stack (taken by debug_backtrace()) with parameters
			 *  describing where (in which namespace) function calling e.g.: Message::get(), has been declared in.
			 * @params: void.
			 * @return: string - package ID or empty string when calling function get/add from global namespace.
			 *  If the function returns empty string it is recommended to set using package by \CORE\CLASSES\Languages\Lang::usePackage(),
			 *  because the function Message::get(), in this case, gets package by \CORE\CLASSES\Languages\Lang::usingPackage().
			 *  It also returns NULL when it is impossible to indicate package.
			 * @throws: -
			**/
			static protected function _indicatePackageID( ){
				$trace = debug_backtrace( );
				if( isset( $trace[2] ) ){
					$trace = $trace[2];
					if( isset( $trace[ 'class' ] ) ){
						$namespace = self::__namespace( $trace[ 'class' ] );
						if( $namespace != NULL )
							return $namespace;
					} else if( isset( $trace[ 'function' ] ) ){
						$namespace = self::__namespace( $trace[ 'function' ] );
						if( $namespace != NULL )
							return $namespace;
					} else return NULL;
				} else return NULL;
			}// end method "_indicatePackageID"
			
		// } private {
			
			private function __construct(){} // unable to instantiate this class
			
			/* Gets namespace of variable $class which could be: an object or a string representing full class name with namespace name.
			 * Method is not able to recognize whether given string represent full class name or another random string. It will use 
			 * given string as it was full (with namespace) class name.
			 * @params: mixed $class,
			 * @return: string - the string representing namespace of $class or NULL if $class is another type than object or string.
			 * @throws: -
			**/
			static private function __namespace( $class ){
				$string = '';
				if( is_object( $class ) )
					$string = get_class( $class );
				else if( is_string( $class ) )
					$string = $class;
				else
					return NULL;
				
				// get namespace:
				$namespace = array( );
				$strlen = strlen( $string );
				$i = $strlen - 1;
				$j = 0;
				while( $i >= 0 && $string[$i--] != "\x5c" );
				while( $j <= $i ) $namespace[$j] = $string[$j++];
				
				return implode( '', $namespace ); 
			}// end method "__namespace"
			
		// }
	// }
}// end class "Message"