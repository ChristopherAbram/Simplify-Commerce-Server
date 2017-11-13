<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * 
 *
 * @package    core\classes\errorhandling\error
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.07.2015
 */
 
namespace core\classes\errorhandling\error; 
 
class CompileWarningException extends \core\classes\errorhandling\error\Error {
	// vars {
		// display options, default: ERRALL
		protected static $_displayOptions	= 0xFF;
		// display error handler, the callback:
		protected static $_display_callback	= array( 'Error', '_defaultDisplayHandler' );
	// } methods {
		
	// }
}// end CompileWarningException