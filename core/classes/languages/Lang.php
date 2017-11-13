<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * 
 *
 * @package    core\classes\languages
 * @author     Christopher Abram
 * @version    1.0
 * @date        23.07.2015
 */
 
namespace core\classes\languages;

final class Lang {
	// vars and constants {
		
		// Current language set by Lang::setLanguage( ) method
		// Is used to indicate the language id for $_messages array, tells where new message should be added:
		static protected $_current_language			= EN;
		
		// Indicates message language which is currently displayed in output:
		static protected $_display_language			= EN;
		
		// Stores default language id - used by function: Lang::__findDefaultMessage():
		static protected $_default_language			= EN;
		
		// Indicates package ID which is currently using:
		static protected $_package					= __GLOBAL__;
		
		// Huge array stores all system messages, warnings, errors etc. Array's content is constructing during run time (loading packages):
		static protected $_messages					= array( );
		
		// Defines type id for messages describing correctly executed operation:
		const CORRECT 		= CORRECT;
		
		// Defines type id for messages describing situations which were executed correctly, but the were some inaccuracies:
		const WARNING		= WARNING;
		
		// Defines type id for messages describing error occurrances:
		const ERROR			= ERROR;
		
		// Defines type id for plain text which is not connected with any communiques:
		const TEXT			= TEXT;
		
	// } methods {
		// public {
			
			/* Sets language id which indicates where new message string will be added to.
			 * Simply sets messages language, added to container - which is array $_messages
			 * @params: string $language - language id,
			 * @return: void,
			 * @throws: -
			**/
			final static public function setLanguage( $language ){
				self::$_current_language = $language;
				return;
			}// end method "setLanguage"
			
			/* Gets language id using in adding mode.
			 * @params: void,
			 * @return: string language id,
			 * @throws: -
			**/
			final static public function getLanguage( ){
				return self::$_current_language;
			}// end method "getLanguage"
			
			/* Sets language id for displaying messages.
			 * @params: string $language - language id (e.g.: pl, en, fr, ...).
			 * @return: void.
			 * @throws: -
			**/
			final static public function setDisplayLanguage( $language ){
				self::$_display_language = $language;
				return;
			}// end method "setDisplayLanguage"
			
			/* Gets language id for displaying messages.
			 * @params: void.
			 * @return: string - language ID.
			 * @throws: -
			**/
			final static public function getDisplayLanguage( ){
				return self::$_display_language;
			}// end method "getDisplayLanguage"
			
			/* Gets currently using package.
			 * @params: void.
			 * @return: string - Returns indentifier of currently using package.
			 * @throws: -
			**/
			final static public function usingPackage( ){
				return self::$_package;
			}// end method "getPackage"
			
			/* Sets currently using package.
			 * @params: string $package - package identifier.
			 * @return: void.
			 * @throws: -
			**/
			final static public function usePackage( $package = __GLOBAL__ ){
				$package = $package === '' ? __GLOBAL__ : $package;
				self::$_package = $package;
				return;
			}// end method "usePackage"
			
			/* Gets appropiate message - indicated by four parameters: package_id, type_id, lang_id, msg_id and does not signal it (NS - No Signal).
			 * @params:
			 *   string $package_id - ID of package.
			 *   int $type - ID of message class.
			 *   string $lang_id - language ID (e.g.: pl/en/...)
			 *   (string/int/float/double) $msg_id - message ID.
			 * @return: string - Returns message indicated by four parameters or empty string if some key does not exist.
			 * @throws: -
			**/
			final static public function getMessageNS( $package_id, $type, $lang_id, $msg_id ){
				global $messages;
				if( !isset( self::$_messages[ $package_id ] ) )
					return '';
					
				if( !isset( self::$_messages[ $package_id ][ $type ] ) )
					return '';
					
				if( !isset( self::$_messages[ $package_id ][ $type ][ $lang_id ] ) )
					return self::__findDefaultMessage( $package_id, $type, $msg_id );	
					
				if( !isset( self::$_messages[ $package_id ][ $type ][ $lang_id ][ $msg_id ] ) )
					return self::__findDefaultMessage( $package_id, $type, $msg_id );
						
				return self::$_messages[ $package_id ][ $type ][ $lang_id ][ $msg_id ];	
			}// end method "getMessageNS"
			
			/* Gets appropiate message - indicated by four parameters: package_id, type_id, lang_id, msg_id.
			 * @params:
			 *   string $package_id - ID of package.
			 *   int $type - ID of message class.
			 *   string $lang_id - language ID (e.g.: pl/en/...)
			 *   (string/int/float/double) $msg_id - message ID.
			 * @return: string - Returns message indicated by four parameters or warning message if some key does not exist.
			 * @throws: -
			**/
			final static public function getMessage( $package_id, $type, $lang_id, $msg_id ){
				global $messages;
				if( !isset( self::$_messages[ $package_id ] ) )
					if( isset( $messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_package' ] ) )
						return self::_replace( 	$messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_package' ], 
												array(
													'$ID'		=> $msg_id,
													'$package'	=> $package_id,
												) 
											);
					else return '';
					
				if( !isset( self::$_messages[ $package_id ][ $type ] ) )
					if( isset( $messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_typeid' ] ) )
						return self::_replace( 	$messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_typeid' ], 
												array(
													'$ID'		=> $msg_id,
													'$typeid'	=> $type,
												) 
											);
					else return '';
					
				if( !isset( self::$_messages[ $package_id ][ $type ][ $lang_id ] ) ){
					$default_message = self::__findDefaultMessage( $package_id, $type, $msg_id );
					if( $default_message == '' )
						if( isset( $messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_langid' ] ) )
							return self::_replace( 	$messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_langid' ], 
													array(
														'$ID'		=> $msg_id,
														'$langid'	=> $lang_id,
													) 
												);
						else return '';	
					else return $default_message;
				}
				if( !isset( self::$_messages[ $package_id ][ $type ][ $lang_id ][ $msg_id ] ) ){
					$default_message = self::__findDefaultMessage( $package_id, $type, $msg_id );
					if( $default_message == '' )
						if( isset( $messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_msgid' ] ) )
							return self::_replace( 	$messages[ __GLOBAL__ ][ self::WARNING ][ self::$_display_language ][ 'no_msgid' ], 
													array(
														'$ID'		=> $msg_id
													) 
												);
						else return '';
					else return $default_message;
				}
						
				return self::$_messages[ $package_id ][ $type ][ $lang_id ][ $msg_id ];	
			}// end method "getMessage"
			
			/* Adds array of messages to the container.
			 * @params:
			 *   string $package_id - ID of package.
			 *   int $type - ID of message class.
			 *   string $lang_id - language ID (e.g.: pl/en/...).
			 *   array $messages - associative array of messages.
			 * @return: void.
			 * @throws: -
			**/
			final static public function addMessages( $package_id, $type, $lang_id, array $messages ){
				foreach( $messages as $msg_id => $message )
					self::$_messages[ $package_id ][ $type ][ $lang_id ][ $msg_id ] = $message;
				return;
			}// end method "addMessage"
			
			/* Adds array of messages to appropriate place in container.
			 * @params: array $messages - associative array of messages.
			 * @return: void.
			 * @throws: -
			**/
			final static public function correct( array $messages ){
				self::addMessages( self::$_package, self::CORRECT, self::$_current_language, $messages );
				return;
			}// end method "correct"
			
			/* Adds array of messages to appropriate place in container.
			 * @params: array $messages - associative array of messages.
			 * @return: void.
			 * @throws: -
			**/
			final static public function warning( array $messages ){
				self::addMessages( self::$_package, self::WARNING, self::$_current_language, $messages );
				return;
			}// end method "warning"
			
			/* Adds array of messages to appropriate place in container.
			 * @params: array $messages - associative array of messages.
			 * @return: void.
			 * @throws: -
			**/
			final static public function error( array $messages ){
				self::addMessages( self::$_package, self::ERROR, self::$_current_language, $messages );
				return;
			}// end method "error"
			
			/* Adds array of messages to appropriate place in container.
			 * @params: array $messages - associative array of messages.
			 * @return: void.
			 * @throws: -
			**/
			final static public function text( array $messages ){
				self::addMessages( self::$_package, self::TEXT, self::$_current_language, $messages );
				return;
			}// end method "text"
			
		// } protected {
			
			/* Replaces occurring key with appropriate replacement in given string $subject
			 * @params:
			 *  string $subject - subject.
			 *  array $replacement - associative array containing keys occurring in string which will be replaced with assigned to this key values.
			 * @return: string - string after replacing all keys in array $replacement.
			 * @throws: -
			**/
			final static protected function _replace( $subject, array $replacement ){
				foreach( $replacement as $key => $value ){
					$key = preg_replace( '/\x24/i', "\\\\$", $key );
					$subject = preg_replace( '/'.$key.'/i', $value, $subject );
				}
				return $subject;
			}// end method "_replace"
			
		// } private {
			
			private function __construct(){} // unable to instantiate this class
			
			/* Tries to find message with id: $msg_id in default language array (Indicated by $_default_language). The function is used 
			 * when msg_id does not exist in array inicated by $_display_language.
			 * @params: 
			 *   string $package - Identifier of package.
			 *	 int $type - class of message.
			 *	 mixed $msg_id - message ID.
			 * @return: string - Returns message string or empty string if given message id does not exist.
			 * @throws: -
			**/
			static private function __findDefaultMessage( $package, $type, $msg_id ){
				if( !isset( self::$_messages[ $package ] ) )
					return '';
				if( !isset( self::$_messages[ $package ][ $type ] ) )
					return '';
				if( !isset( self::$_messages[ $package ][ $type ][ self::$_default_language ] ) )
					return '';
				if( !isset( self::$_messages[ $package ][ $type ][ self::$_default_language ][ $msg_id ] ) )
					return '';
				return self::$_messages[ $package ][ $type ][ self::$_default_language ][ $msg_id ];
			}// end method "__findDefaultMessage"
			
		// }
	// }
}// end class "Lang"