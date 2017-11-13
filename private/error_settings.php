<?php
/**
 * Copyright (c) 2016 Christopher Abram.
 *
 * Error Handling Settings
 *
 * @package    error_settings.php
 * @author     Christopher Abram
 * @version    1.0
 * @date       18.08.2016
 */

// Loading package for error handling:
require_once realpath( dirname(__FILE__).'/../core/classes/errorhandling/load.php' );

use \core\classes\errorhandling\ErrorHandler;

// } Error Handler Initializing {
$error_handler = ErrorHandler::getInstance( );
$error_handler->initialize( DISPLAY_ERRORS | DISPLAY_STARTUP_ERRORS | LOG_ERRORS | IGNORE_REPEATED_ERRORS | IGNORE_REPEATED_SOURCE | REPORT_MEMLEAKS | TRACK_ERRORS );
$error_handler->setIniOptions( array(
					LOG_ERRORS_MAX_LEN	=> 2048,
					ERROR_LOG		=> '/private/php_errors.log',
				) );			
$error_handler->error_reporting( E_ALL );

/*echo '<pre>';
print_r( $error_handler->getIniOptions() );
echo '<pre/>';
exit;*/

use \core\classes\errorhandling\error;
	
// } FatalErrorException settings {
error\FatalErrorException::setDisplayOptions( ERRALL );

// } WarningException settings {
error\WarningException::setDisplayOptions( ERRALL & ~ERRTRC & ~ERRCOD );

// } ParseException settings {
error\ParseException::setDisplayOptions( ERRALL );
	
// } NoticeException settings {
error\NoticeException::setDisplayOptions( ERRALL & ~ERRTRC & ~ERRCOD );

// }