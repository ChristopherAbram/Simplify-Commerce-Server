<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Abstract class error definig constants end methods for error handling in system.
 *
 * @package    core\classes\errorhandling\error
 * @author     Christopher Abram
 * @version    1.0
 * @date	25.07.2015
 */
 
namespace core\classes\errorhandling\error;
 
abstract class Error extends \ErrorException {
	// vars {
		const ERRNUM 		= ERRNUM; // error number
		const ERRTIT		= ERRTIT; // error title
		const ERRMSG		= ERRMSG; // error message
		const ERRLOC		= ERRLOC; // error location
		const ERRSEV		= ERRSEV; // error severity
		const ERRTRC		= ERRTRC; // error backtrace
		const ERRCOD		= ERRCOD; // error code
		const ERRCNX		= ERRCNX; // error context
		const ERRALL		= ERRALL; // all errors
		
		// display options, default: ERRALL & ~ERRTRC
		protected static $_displayOptions	= 0xDF;
		// display error handler, the callback:
		protected static $_display_callback	= array( 'Error', '_defaultDisplayHandler' );
		
	// } methods {
		// public {
			
			/* Sets options for displaying communique.
			 * @params: int $options - bit mask defining which information about error should be displayed.
			 * @return: void
			 * @throws: -
			**/
			final static public function setDisplayOptions( $options ){
				static::$_displayOptions = $options;
				return;
			}// end method "setDisplayOptions"
			
			/* Gets options for displaying communique.
			 * @params: void
			 * @return: int - value of $_displayOptions.
			 * @throws: -
			**/
			final static public function displayOptions( ){
				return static::$_displayOptions;
			}// end method "getDisplayOptions"
			
			/* Restores default options for displaying errors.
			 * @params: void
			 * @return: void
			 * @throws: -
			**/
			final static public function restoreDisplayOptions( ){
				static::$_displayOptions = self::ERRALL & ~self::ERRTRC;
				return;
			}// end method "restoreDisplayOptions"
			
			/* Sets display handler
			 * @params: callable $callback - callback specifying communique output string.
			 * @return: bool - returns TRUE if successfully set $callback (if is callable), otherwise FALSE.
			 * @throws: -
			**/
			final static public function setDisplayHandler( $callback ){
				if( is_callable( $callback, true ) ){
					static::$_display_callback = $callback;
					return true;
				}
				return false;
			}// end method "setDisplayHandler"
			
			/* Restores default error display handler.
			 * @params: void
			 * @return: void
			 * @throws: -
			**/
			final static public function restoreDisplayHandler( $callback ){
				static::$_display_callback = self::$_display_callback;
				return;
			}// end method "restoreDisplayHandler"
			
			/* Gets communique string by executing previously set $_display_callback (using Error::setDisplayHandler)
			 * @params: void
			 * @return: string - communique output string
			 * @throws: -
			**/
			final public function getCommunique( ){
				$this->__prepareCallbackFormat( );
				return call_user_func( static::$_display_callback, $this );
			}// end method "getCommunique" 
			
		// } protected {
			
			/* Default functions specifying communique output string.
			 * @params: Error $error - instance of class Error.
			 * @return: sting - returns communique output string.
			 * @throws: -
			**/
			protected function _defaultDisplayHandler( Error $error ){
				//header( "Content-Type: text/html; charset=utf-8" );
				$bitmask = $error->displayOptions( );
				
				$default_type = array(
					E_ERROR				=> 'E_ERROR',
					E_WARNING			=> 'E_WARNING',
					E_PARSE				=> 'E_PARSE',
					E_NOTICE			=> 'E_NOTICE',
					E_CORE_ERROR		=> 'E_CORE_ERROR',
					E_CORE_WARNING		=> 'E_CORE_WARNING',
					E_COMPILE_ERROR		=> 'E_COMPILE_ERROR',
					E_COMPILE_WARNING	=> 'E_COMPILE_WARNING',
					E_USER_ERROR		=> 'E_USER_ERROR',
					E_USER_WARNING		=> 'E_USER_WARNING',
					E_USER_NOTICE		=> 'E_USER_NOTICE',
					E_STRICT			=> 'E_STRICT',
					E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
					E_DEPRECATED		=> 'E_DEPRECATED',
					E_USER_DEPRECATED	=> 'E_USER_DEPRECATED',
					E_ALL				=> 'E_ALL',
				);
				
				$default_title = array(
					E_ERROR				=> 'Fatal run-time error',
					E_WARNING			=> 'Run-time warning',
					E_PARSE				=> 'Compile-time parse error',
					E_NOTICE			=> 'Run-time notice',
					E_CORE_ERROR		=> 'Fatal error occurred during initial startup',
					E_CORE_WARNING		=> 'Warning occurred during initial startup',
					E_COMPILE_ERROR		=> 'Fatal compile-time error',
					E_COMPILE_WARNING	=> 'Compile-time warning',
					E_USER_ERROR		=> 'User-generated error',
					E_USER_WARNING		=> 'User-generated warning',
					E_USER_NOTICE		=> 'User-generated notice',
					E_STRICT			=> 'Strict suggest',
					E_RECOVERABLE_ERROR => 'Recoverable fatal error',
					E_DEPRECATED		=> 'Run-time deprecated',
					E_USER_DEPRECATED	=> 'User-generated deprecated warning',
					E_ALL				=> 'All errors',
				);
				
				$default_header = array(
					'errloc'		=> 'Lokalizacja',
					'errcnx'		=> 'Kontekst wystąpienia błędu',
					'errcod'		=> 'Kod błędu',
					'errmsg'		=> 'Wiadomość',
					'errtrc'		=> 'Ślad wywołań stosu',
					'errtim'		=> 'Czas wygenerowania błędu',
					'errnum'		=> 'Numer błędu',
					'errsev'		=> 'Dotkliwość błędu',
				);
				
				// Messages or error displaying:
				$title = Text::get( 'title' );
				$description = Text::get( 'description' );
				$type = Text::get( 'type' );
				$header = Text::get( 'header' );
				$backtrace = Text::get( 'backtrace' );
				
				$communique = <<<"COMMUNIQUE"
<div style="width: 720px; padding: 0px 0px 0px 0px; border-bottom: solid 3px #dbdbdb; border-right: solid 1px #dbdbdb; border-left: solid 1px #dbdbdb; background: #efefef; margin: 0 auto;">
	<!-- Title bar -->
	<div style="width: 100%; border-bottom: solid 1px #666; background: #666; color: #efefef">
    	<div style="padding: 30px ; font-family:Verdana, Geneva, sans-serif; font-size: 1.5em;">
			
COMMUNIQUE;
				if( ($bitmask & self::ERRSEV) && $type != '' && isset( $type[ $error->getSeverity() ] ) )
					$communique .= "[<span style='color: #ff8b8b; font-size: 0.8em;'>".$type[ $error->getSeverity() ]."</span>] ";
				else if( !isset( $type[ $error->getSeverity() ] ) && isset( $default_type[ $error->getSeverity() ] ) )
					$communique .= "[<span style='color: #ff8b8b; font-size: 0.8em;'>".$default_type[ $error->getSeverity() ]."</span>] ";
					
				if( ($bitmask & self::ERRTIT) && $title != '' && isset( $title[$error->getSeverity() ] ) )
					$communique .= $title[ $error->getSeverity() ];
				else if( !isset( $title[$error->getSeverity() ] ) && isset( $default_title[ $error->getSeverity() ] ) )
					$communique .= $default_title[ $error->getSeverity() ];

				$communique .= <<<"COMMUNIQUE"
        </div>
    </div>
    
    <!-- Content -->
    <div style="padding: 10px; font-family: Verdana, Geneva, sans-serif; font-size: 0.9em; color: #666;">
COMMUNIQUE;
				if( ($bitmask & self::ERRLOC) && isset( $header[ 'errloc' ] ) )   
					$communique .= <<<"COMMUNIQUE"
					
    	<div style="border-bottom: dashed 1px #dbdbdb; padding: 5px 0;">
        {$header[ 'errloc' ]}: ({$error->getLine()}) {$error->getFile()}
        </div>
COMMUNIQUE;
				else if( !isset( $header[ 'errloc' ] ) )
					$communique .= <<<"COMMUNIQUE"
					
    	<div style="border-bottom: dashed 1px #dbdbdb; padding: 5px 0;">
        {$default_header[ 'errloc' ]}: ({$error->getLine()}) {$error->getFile()}
        </div>
		
COMMUNIQUE;
				
				if( isset( $header[ 'errcnx' ] ) )
					$communique .= "{$header[ 'errcnx' ]}:";
				else if ( !isset( $header[ 'errcnx' ] ) )
					$communique .= "{$default_header[ 'errcnx' ]}:";
				
				if( $bitmask & self::ERRCNX ){
					$communique .= <<<"COMMUNIQUE"
				
		<div style="font-family: 'Lucida Console', Monaco, monospace; font-size: 11px;border-bottom: solid 1px #dbdbdb; padding: 2px; background: #666; color: #efefef;">
			<div style="border: dotted 1px #dbdbdb">
				<pre>
COMMUNIQUE;

					// Getting file content as an array:
					$lines = @file( $error->getFile() );
					if( is_array( $lines ) && !empty( $lines ) ){
						$_visible_lines = 10;
						// Number of begining line:
						$b = $error->getLine( ) < ( $_visible_lines + 1 ) ? 0 : ($error->getLine( ) - $_visible_lines - 1);
						// Number of ending line:
						$e = $error->getLine( ) > ( sizeof( $lines ) - $_visible_lines ) ? sizeof( $lines ) : ($error->getLine( ) + $_visible_lines - 1);
						
						for( $i = $b; $i <= $e; $i++ ){
							if( isset( $lines[ $i ] ) ){
								if( ($i + 1) == $error->getLine() ){ // coloring line where problem occured;
									$communique .= "<span style='color: #ff8b8b'> ".($i + 1)." |  ".$lines[ $i ]."</span>";
									continue;
								}
								$communique .= " ".($i + 1)." |  ".$lines[ $i ];
							}
						}
					}
					$communique .= <<<"COMMUNIQUE"
				</pre>
			</div>
		</div>
COMMUNIQUE;
				}

				if( ($bitmask & self::ERRCOD) && isset( $header[ 'errcod' ] ) )
					$communique .= <<<"COMMUNIQUE"
					
        <div style="border-bottom: dashed 1px #dbdbdb; padding: 2px 0; font-size: 12px;">
        {$header[ 'errcod' ]}: {$error->getCode()}
        </div>
COMMUNIQUE;
				else if( !isset( $header[ 'errcod' ] ) )
    				$communique .= <<<"COMMUNIQUE"
					
        <div style="border-bottom: dashed 1px #dbdbdb; padding: 2px 0; font-size: 12px;">
        {$default_header[ 'errcod' ]}: {$error->getCode()}
        </div>
COMMUNIQUE;
				
				$communique .= <<<"COMMUNIQUE"
				
    	<div style="border-bottom: dashed 1px #dbdbdb; padding: 5px 0;">
COMMUNIQUE;

				if( ($bitmask & self::ERRMSG) && isset( $description[ $error->getSeverity() ] ) )
        			$communique .= "
					<p>{$error->getMessage()}</p>"."<p>{$description[ $error->getSeverity() ]}</p>";
				else if( !isset( $description[ $error->getSeverity() ] ) )
					$communique .= "<p>{$error->getMessage()}</p>";			

				
				if( $bitmask & self::ERRTRC ){
					$trace = debug_backtrace( );
					
					if( isset( $header[ 'errtrc' ] ) && sizeof( $trace ) > 0 )
						$communique .= <<<"COMMUNIQUE"
					
			<div style="font-size: 1.3em; padding: 10px 0;">{$header[ 'errtrc' ]}:</div>

			<div style="border: dashed 4px #dbdbdb; font-size: 11px;">
COMMUNIQUE;
					else if( sizeof( $trace ) > 0 )
						$communique .= <<<"COMMUNIQUE"
					
			<div style="font-size: 1.3em; padding: 10px 0;">{$default_header[ 'errtrc' ]}:</div>

			<div style="border: dashed 4px #dbdbdb; font-size: 11px;">
COMMUNIQUE;

					
					
					if( sizeof( $trace ) > 0 ){
					
					foreach( $trace as $frame ){
						$communique .= '
						
				<div style="margin: 3px; background: #e6e6e6">';
				
						if( isset( $frame[ 'function' ] ) )
							$communique .= '
                    <div style="border-bottom: dashed 1px #dbdbdb; padding: 2px 10px;">
                    Function: '.$frame['function'].'
                    </div>';
						
						if( isset( $frame[ 'line' ] ) )
							$communique .= '
                    <div style="border-bottom: dashed 1px #dbdbdb; padding: 2px 10px;">
                    Line: '.$frame['line'].'
                    </div>';
					
						if( isset( $frame[ 'file' ] ) )
							$communique .= '
                    <div style="border-bottom: dashed 1px #dbdbdb; padding: 2px 10px;">
                    File: '.$frame['file'].'
                    </div>';
					
						if( isset( $frame[ 'class' ] ) )
							$communique .= '
                    <div style="border-bottom: dashed 1px #dbdbdb; padding: 2px 10px;">
                    Class: '.$frame['class'].'
                    </div>';
					
						if( isset( $frame[ 'type' ] ) )
							$communique .= '
                    <div style="border-bottom: dashed 1px #dbdbdb; padding: 2px 10px;">
                    Call method: '.$frame['type'].'
                    </div>';
					
						/*if( isset( $frame[ 'args' ] ) )
							$communique .= '
                    <div style="padding: 2px 10px;">
                    Arguments: 
					<pre>'.print_r($frame['args'], true).'</pre>
                    </div>';*/
					
						$communique .= '
                </div>
				';
					}	
					}
			
            	$communique .= <<<"COMMUNIQUE"
				
            </div>
COMMUNIQUE;
				}
				$date = date( 'H:i:s d.m' );
				if( isset( $header[ 'errtim' ] ) )
   					$communique .= <<<"COMMUNIQUE"
		</div>
		<div style="padding: 5px 0;">
		{$header[ 'errtim' ]}: {$date}
		</div>
	</div>
</div>
COMMUNIQUE;
				else 
					$communique .= <<<"COMMUNIQUE"
		</div>
		<div style="padding: 5px 0;">
		{$default_header[ 'errtim' ]}: {$date}
		</div>
	</div>
</div>
COMMUNIQUE;
				
				return $communique;
			}// end method "defaultDisplayHandler"
			
		// } private {
			
			/* Prepares $_display_callback format before call
			 * @params: void
			 * @return: void
			 * @throws: -
			**/
			private function __prepareCallbackFormat( ){
				if ( is_array( static::$_display_callback ) && is_array( self::$_display_callback ) && isset( static::$_display_callback[0], self::$_display_callback[0] ) )
					if( static::$_display_callback[0] === self::$_display_callback[0] )
						static::$_display_callback[0] = "\x5c".__NAMESPACE__."\x5c".static::$_display_callback[0];
				return;
			}// end method "__prepareCallbackFormat"
			
		// }
	// }
}// end Error