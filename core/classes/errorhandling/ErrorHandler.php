<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\errorhandling
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.07.2015
 */
 
namespace core\classes\errorhandling;

final class ErrorHandler {
	// vars {
		private static $instance 		= NULL;
		
		// sets the error reporting level:
		private $error_reporting		= -1;
		// sets the maximum length of log_errors in bytes:
		private $log_errors_max_len		= 1024;
		// used as the value of the XML-RPC faultCode element:
		private $xmlrpc_error_number	= 0;
		// reference to a page describing the error or function causing the error:
		private $docref_root			= "/phpmanual/";
		// fileextensions:
		private $docref_ext				= ".html";
		// string to output before an error message:
		private $error_prepend_string	= "";
		// string to output after an error message:
		private $error_append_string	= "";
		// name of the file where script errors should be logged:
		private $error_log				= "php_errors.log";
		
		// determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user:
		const DISPLAY_ERRORS 			= DISPLAY_ERRORS;
		// determines whether errors that occur during PHP's startup sequence are not displayed or displayed (recommanded for debugging):
		const DISPLAY_STARTUP_ERRORS 	= DISPLAY_STARTUP_ERRORS; 
		// tells whether script errors messages should be logged to the server's error log or error_log:
		const LOG_ERRORS				= LOG_ERRORS;
		// determines whether repeated errors should be logged:
		const IGNORE_REPEATED_ERRORS	= IGNORE_REPEATED_ERRORS;
		// ignore source of message when ignoring repeated messages:
		const IGNORE_REPEATED_SOURCE	= IGNORE_REPEATED_SOURCE;
		// determines whether to show a report of memory leaks detected by the Zend memory manager:
		const REPORT_MEMLEAKS			= REPORT_MEMLEAKS;
		// determines whether last error message will always be present in the variable $php_errormsg:
		const TRACK_ERRORS				= TRACK_ERRORS;
		// determines whether HTML tags should be printed in error messages:
		const HTML_ERRORS				= HTML_ERRORS;
		// turns off normal error reporting and formats errors as XML-RPC error message:
		const XMLRPC_ERRORS				= XMLRPC_ERRORS;
	// } methods {
		
		/* Sets private vars for errorHandler
		 * @params: void,
		 * @return: void,
		 * @throws: -
		**/
		private function __construct(){
			// setting error handler:
			@set_error_handler( array( $this, 'error_handler' ), E_ALL );
			// setting exception handler:
			@set_exception_handler( array( $this, 'exception_handler' ) );
			// setting shutdown function:
			@register_shutdown_function( array( $this, 'shutdown_function' ) );
			
			$this->__update( );
		}// end __construct
		
		/* Sets private vars for errorHandler
		 * @params: void,
		 * @return: void,
		 * @throws: -
		**/
		private function __update(){
			$this->error_reporting 		= @ini_get( 'error_reporting' );
			$this->log_errors_max_len 	= @ini_get( 'log_errors_max_len' );
			$this->xmlrpc_error_number	= @ini_get( 'xmlrpc_error_number' );
			$this->docref_root			= @ini_get( 'docref_root' );
			$this->docref_ext			= @ini_get( 'docref_ext' );
			$this->error_prepend_string = @ini_get( 'error_prepend_string' );
			$this->error_append_string  = @ini_get( 'error_append_string' );
			$this->error_log			= @ini_get( 'error_log' );
			return;
		}// end __update
		
		/* Singleton pattern.
		 * @params: void,
		 * @return: object - errorHandler instance.
		 * @throws: -
		**/
		final public static function getInstance( ){
			if( empty($instance) ){
				self::$instance = new ErrorHandler();
			}
			return self::$instance;
		}// end getInstance
		
		/* Initaizes php.ini vars according to the given bitmask
		 * @params: int $bitmask - bitmask which ini vars should be 0 or 1,
		 * @return: void
		 * @throws: -
		*/
		final public function initialize( $bitmask ){
			$bitmask & self::DISPLAY_ERRORS ? 			@ini_set( 'display_errors', 1 ) : 			@ini_set( 'display_errors', 0 );
			$bitmask & self::DISPLAY_STARTUP_ERRORS ? 	@ini_set( 'display_startup_errors', 1 ) : 	@ini_set( 'display_startup_errors', 0 );
			$bitmask & self::LOG_ERRORS ? 				@ini_set( 'log_errors', 1 ) : 				@ini_set( 'log_errors', 0 );
			$bitmask & self::IGNORE_REPEATED_ERRORS ? 	@ini_set( 'ignore_repeated_errors', 1 ) : 	@ini_set( 'ignore_repeated_errors', 0 );
			$bitmask & self::IGNORE_REPEATED_SOURCE ? 	@ini_set( 'ignore_repeated_source', 1 ) : 	@ini_set( 'ignore_repeated_source', 0 );
			$bitmask & self::REPORT_MEMLEAKS ? 			@ini_set( 'report_memleaks', 1 ) : 			@ini_set( 'report_memleaks', 0 );
			$bitmask & self::TRACK_ERRORS ? 			@ini_set( 'track_errors', 1 ) : 				@ini_set( 'track_errors', 0 );
			$bitmask & self::HTML_ERRORS ? 				@ini_set( 'html_errors', 1 ) : 				@ini_set( 'html_errors', 0 );
			$bitmask & self::XMLRPC_ERRORS ? 			@ini_set( 'xmlrpc_errors', 1 ) : 			@ini_set( 'xmlrpc_errors', 0 );
			return;
		}// end initialize
		
		/* Sets ini options
		 * @params: array $options - value for appropiate ini vars
		 * @return: void
		 * @throws: -
		**/
		final public function setIniOptions( array $options ){
			if( isset( $options[ 'log_errors_max_len' ] ) ) 	@ini_set( 'log_errors_max_len', 		$options[ 'log_errors_max_len' ] );
			if( isset( $options[ 'xmlrpc_error_number' ] ) ) 	@ini_set( 'xmlrpc_error_number', 	$options[ 'xmlrpc_error_number' ] );
			if( isset( $options[ 'docref_root' ] ) ) 			@ini_set( 'docref_root', 			$options[ 'docref_root' ] );
			if( isset( $options[ 'docref_ext' ] ) ) 			@ini_set( 'docref_ext', 				$options[ 'docref_ext' ] );
			if( isset( $options[ 'error_prepend_string' ] ) ) 	@ini_set( 'error_prepend_string', 	$options[ 'error_prepend_string' ] );
			if( isset( $options[ 'error_append_string' ] ) ) 	@ini_set( 'error_append_string', 	$options[ 'error_append_string' ] );
			if( isset( $options[ 'error_log' ] ) ) 				@ini_set( 'error_log', 				$options[ 'error_log' ] );
			$this->__update( ); // variables update
			return;
		}// end setIniOptions
		
		/* Gets all ini option connected with error handling
		 * @params: void.
		 * @return: array - all ini vars about error reporting
		 * @throws: -
		**/
		final public function getIniOptions( ){
			return array(
				'display_errors'			=> @ini_get( 'display_errors' ),
				'display_startup_errors'	=> @ini_get( 'display_startup_errors' ),
				'log_errors'				=> @ini_get( 'log_errors' ),
				'log_errors_max_len'		=> @ini_get( 'log_errors_max_len' ),
				'ignore_repeated_errors'	=> @ini_get( 'ignore_repeated_errors' ),
				'ignore_repeated_source'	=> @ini_get( 'ignore_repeated_source' ),
				'report_memleaks'			=> @ini_get( 'report_memleaks' ),
				'track_errors'				=> @ini_get( 'track_errors' ),
				'html_errors'				=> @ini_get( 'html_errors' ),
				'xmlrpc_errors'				=> @ini_get( 'xmlrpc_errors' ),
				'xmlrpc_error_number'		=> @ini_get( 'xmlrpc_error_number' ),
				'docref_root'				=> @ini_get( 'docref_root' ),
				'docref_ext'				=> @ini_get( 'docref_ext' ),
				'error_prepend_string'		=> @ini_get( 'error_prepend_string' ),
				'error_append_string'		=> @ini_get( 'error_append_string' ),
				'error_log'					=> @ini_get( 'error_log' ),
			);
		}// end getIniOptions
		
		/* Handling error type of E_... by throwing exceptions
		 * @params:
		  - int $errno - error number,
		  - string $errstr - error's message string,
		  - string $errfile - ścieżka (nazwa) pliku, w którym wystąpił błąd,
		  - int $errline - numer lini w pliku errfile, w której wystąpił błąd,
		  - array $errcontext - tablica 
		 * @return: bool
		 * @throws: specific Error type Exception
		**/
		final public function error_handler( $errno, $errstr, $errfile, $errline, array $errcontext ){
			if( !($errno & error_reporting()) ){
				//throw new Exception( /* params */ );
				return false;
			}
			
			
			
			switch( $errno ){
				case E_WARNING:
				/*echo '<pre>';
			print_r( array( $errno, $errstr, $errfile, $errline, $errcontext ) );
			echo '<pre/>';
			exit;*/
					throw new error\WarningException( $errstr, 0, $errno, $errfile, $errline );
					break;
				case E_NOTICE:
					throw new error\NoticeException( $errstr, 0, $errno, $errfile, $errline );
					break;
				case E_USER_ERROR:
					throw new error\UserErrorException( $errstr, 0, $errno, $errfile, $errline );
					break;
				case E_USER_WARNING:
					throw new error\UserWarningException( $errstr, 0, $errno, $errfile, $errline );
					break;
				case E_USER_NOTICE:
					throw new error\UserNoticeException( $errstr, 0, $errno, $errfile, $errline );
					break;
				case E_RECOVERABLE_ERROR:
					throw new error\RecoverableErrorException( $errstr, 0, $errno, $errfile, $errline );
					break;
				case E_DEPRECATED:
					throw new error\DeprecatedException( $errstr, 0, $errno, $errfile, $errline );
					break;
				case E_USER_DEPRECATED:
					throw new error\UserDeprecatedException( $errstr, 0, $errno, $errfile, $errline );
					break;
			}
			return true;
		}// end error_handler
		
		/* Sets the default exception handler if an exception is not caught within a try/catch block.
		 * @params: Exception $exception - Exception instance, 
		 * @return: bool - always true
		 * @throws: -
		**/
		final public function exception_handler( \Exception $exception ){
			if( $exception instanceof \ErrorException ){
				echo $exception->getCommunique( );
			} else {
				$warning = new error\WarningException( 'Uncaught exception \''.get_class( $exception ).'\' with message \''.$exception->getMessage().'\'.', 0, E_WARNING, $exception->getFile(), $exception->getLine() );
				echo $warning->getCommunique( );
				exit;
			}
			return true;
		}// end exception_handler
		
		/* Executes code after script execution finishes
		 * @params: void,
		 * @return: void,
		 * @throws: -
		**/
		final public function shutdown_function( ){
			$error = error_get_last( );
			
			if( !is_null( $error ) ){
				if( (int)$error['type'] & error_reporting() )
					switch( $error[ 'type' ] ){
						case E_ERROR: {
							$fatalError = new error\FatalErrorException( $error[ 'message' ], 0, $error[ 'type' ], $error[ 'file' ], $error[ 'line' ] );
							echo $fatalError->getCommunique( );
						} break;
						case E_PARSE: {
							$parseError = new error\ParseException( $error[ 'message' ], 0, $error[ 'type' ], $error[ 'file' ], $error[ 'line' ] );			
							echo $parseError->getCommunique( );
						} break;
						case E_CORE_ERROR: {
							$coreError = new error\CoreErrorException( $error[ 'message' ], 0, $error[ 'type' ], $error[ 'file' ], $error[ 'line' ] );
							echo $coreError->getCommunique( );
						} break;
						case E_CORE_WARNING: {
							$coreWarning = new error\CoreWarningException( $error[ 'message' ], 0, $error[ 'type' ], $error[ 'file' ], $error[ 'line' ] );
							echo $coreWarning->getCommunique( );
						} break;
						case E_COMPILE_ERROR: {
							$compileError = new error\CompileErrorException( $error[ 'message' ], 0, $error[ 'type' ], $error[ 'file' ], $error[ 'line' ] );
							echo $compileError->getCommunique( );
						} break;
						case E_COMPILE_WARNING: {
							$compileWarning = new error\CompileWarningException( $error[ 'message' ], 0, $error[ 'type' ], $error[ 'file' ], $error[ 'line' ] );
							$compileError->getCommunique( );
						} break;
						case E_STRICT: {
							$strictError =  new error\StrictException( $error[ 'message' ], 0, $error[ 'type' ], $error[ 'file' ], $error[ 'line' ] );
							echo $strictError->getCommunique( );
						} break;
					}
			}
			return;
		}// end shutdown_function
		
		/* Sets level of error reporting.
		 * @params: int $level, 
		 * @return: int - the old error_reporting level or the current level if level is NULL
		 * @throws: -
		**/
		final public function error_reporting( $level = NULL ){
			if( $level === NULL )
				return error_reporting( );
			else {
				$this->error_reporting = $level;
				return error_reporting( $level );
			}
		}// end error_reporting
		
		/* Log error in $this->error_log file
		 * @params: string $message - error message saved in error_log file
		 * @return: void
		 * @throws: -
		**/
		final public function error_log( $message ){
			error_log( $message );
			return;
		}// end error_log
	// }
}// end ErrorHandler